<?php
class Board_Context
{

    /**
     * Request method
     * @var string GET|POST|XMLRPC
     */
    public $request_method = 'GET';

    /**
     * Conatins request parameters and environment variables
     * @var object
     */
    public $board_context = NULL;

    /**
     * variables from GET or form submit
     * @var mixed
     */
    public $get_vars = NULL;

    function __construct(){
    }

    /**
     * returns static board_context object (Singleton). It's to use BoardContext without declaration of an object
     *
     * @return object Instance
     */
    function &getInstance()
    {
        static $theInstance = null;

        if(!$theInstance)
        {
            $theInstance = new BoardContext();
        }

        return $theInstance;
    }

    function init()
    {
        // set board_context variables in $GLOBALS (to use in display handler)
        $this->board_context = &$GLOBALS['__BoardContext__'];

        $this->setRequestMethod('');
        $this->_setRequestArgument();
        $this->_setUploadedArgument();
    }

    /**
     * handle request areguments for GET/POST
     *
     * @return void
     */
    function _setRequestArgument()
    {
        if(!count($_REQUEST))
        {
            return;
        }

        $requestMethod = $this->getRequestMethod();
        foreach($_REQUEST as $key => $val)
        {
            if($val === '' || self::get($key))
            {
                continue;
            }
            if($requestMethod == 'GET' && isset($_GET[$key]))
            {
                $set_to_vars = TRUE;
            }
            elseif($requestMethod == 'POST' && isset($_POST[$key]))
            {
                $set_to_vars = TRUE;
            }
            else
            {
                $set_to_vars = FALSE;
            }

            $this->set($key, $val, $set_to_vars);
        }
    }

    /**
     * Handle uploaded file
     *
     * @return void
     */
    function _setUploadedArgument()
    {
        if($_SERVER['REQUEST_METHOD'] != 'POST' || !$_FILES || stripos($_SERVER['CONTENT_TYPE'], 'multipart/form-data') === FALSE)
        {
            return;
        }

        foreach($_FILES as $key => $val)
        {
            $tmp_name = $val['tmp_name'];
            if(!is_array($tmp_name))
            {
                if(!$tmp_name || !is_uploaded_file($tmp_name))
                {
                    continue;
                }
                $val['name'] = htmlspecialchars($val['name'], ENT_COMPAT | ENT_HTML401, 'UTF-8', FALSE);
                $this->set($key, $val, TRUE);
                $this->is_uploaded = TRUE;
            }
            else
            {
                for($i = 0, $c = count($tmp_name); $i < $c; $i++)
                {
                    if($val['size'][$i] > 0)
                    {
                        $file['name'] = $val['name'][$i];
                        $file['type'] = $val['type'][$i];
                        $file['tmp_name'] = $val['tmp_name'][$i];
                        $file['error'] = $val['error'][$i];
                        $file['size'] = $val['size'][$i];
                        $files[] = $file;
                    }
                }
                $this->set($key, $files, TRUE);
            }
        }
    }

    /**
     * Determine request method
     *
     * @param string $type Request method. (Optional - GET|POST|XMLRPC|JSON)
     * @return void
     */
    function setRequestMethod($type = '')
    {
        is_a($this, 'BoardContext') ? $self = $this : $self = self::getInstance();

        ($type && $self->request_method = $type) or
            (strpos($_SERVER['CONTENT_TYPE'], 'json') && $self->request_method = 'JSON') or
            ($GLOBALS['HTTP_RAW_POST_DATA'] && $self->request_method = 'XMLRPC') or
            ($self->js_callback_func && $self->request_method = 'JS_CALLBACK') or
            ($self->request_method = $_SERVER['REQUEST_METHOD']);
    }

    /**
     * Return request method
     * @return string Request method type. (Optional - GET|POST|XMLRPC|JSON)
     */
    function getRequestMethod()
    {
        is_a($this, 'BoardContext') ? $self = $this : $self = self::getInstance();
        return $self->request_method;
    }

    /**
     * Set a board_context value with a key
     *
     * @param string $key Key
     * @param string $val Value
     * @param mixed $set_to_get_vars If not FALSE, Set to get vars.
     * @return void
     */
    function set($key, $val, $set_to_get_vars = 0)
    {
        is_a($this, 'BoardContext') ? $self = $this : $self = self::getInstance();
        $self->board_context->{$key} = $val;
        if($set_to_get_vars === FALSE)
        {
            return;
        }
        if($val === NULL || $val === '')
        {
            unset($self->get_vars->{$key});
            return;
        }
        if($set_to_get_vars || $self->get_vars->{$key})
        {
            $self->get_vars->{$key} = $val;
        }
    }

    /**
     * Return key's value
     *
     * @param string $key Key
     * @return string Key
     */
    function get($key)
    {
        is_a($this, 'BoardContext') ? $self = $this : $self = self::getInstance();
        if(!isset($self->board_context->{$key}))
        {
            return null;
        }
        return $self->board_context->{$key};
    }

    /**
     * Return values from the GET/POST/XMLRPC
     *
     * @return Object Request variables.
     */
    function getRequestVars()
    {
        is_a($this, 'BoardContext') ? $self = $this : $self = self::getInstance();
        if($self->get_vars)
        {
            return clone($self->get_vars);
        }
        return new stdClass;
    }
}

