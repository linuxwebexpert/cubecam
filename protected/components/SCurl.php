<?php 
class SCurl
{
	
	public $timeout;
	public $request;
	public $post;			// null
	public $useCookie;		//'cookies.txt'
	public $referer;		// null
	public $proxy;			// null
	public $opt;
	
	public function __construct($request=null,$referer=null,$timeout=30,$post=null,$useCookie='cookies.txt',$proxy=null)
	{
		$this->request = $request;
		$this->timeout = $timeout;
		$this->post = $post;
		$this->useCookie = Yii::app()->basePath."/".$useCookie;
		$this->referer = $referer;
		$this->proxy = $proxy;
	}
	
	private function check ()
	{
		if( !function_exists("curl_init") ||
		!function_exists("curl_setopt") ||
		!function_exists("curl_exec") ||
		!function_exists("curl_close") ) return false;
		else return true;
	}
	
	public function curl ($close=true)
	{
			
		$ok = $this->check();
	
		if (!$ok)
		{
			trigger_error("Curl basic functions are missing, please check PHP configuration!");
			return false;
		}
	
		// if passed a "cookies.txt" let's see if we can use it...
		if (!empty($this->useCookie))
		{
			if (file_exists($this->useCookie))
			{
				if (!is_writeable($this->useCookie))
				{
					trigger_error("Could not write to cookie file :: $this->useCookie");
					return false;
				}
			} 
			else 
			{
				if (!touch($this->useCookie))
				{
					trigger_error("Could not find cookie file $this->useCookie");
					return false;
				}
			}
		}
	
	
		// Set cURL options
		$this->opt[CURLOPT_URL] = $this->request;
		$this->opt[CURLOPT_TIMEOUT] = $this->timeout;
		$this->opt[CURLOPT_CONNECTTIMEOUT] = $this->timeout;
		$this->opt[CURLOPT_HEADER] = false;
		$this->opt[CURLOPT_USERAGENT] =  "Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.6) Gecko/20070725 Firefox/2.0.0.6";
		$this->opt[CURLOPT_ENCODING] =  "";
	
		if (!empty($this->useCookie))
		{
			$this->opt[CURLOPT_COOKIEJAR] = $this->useCookie;
			$this->opt[CURLOPT_COOKIEFILE] = $this->useCookie;
		}
	
		if (!empty($refer))
		{
			$this->opt[CURLOPT_REFERER] = $refer;
		} else {
			$this->opt[CURLOPT_AUTOREFERER] = true;
		}
	
		if (!empty($this->post))
		{
			$this->opt[CURLOPT_POST] =  1;
			if (!is_array($this->post))
			{
				$this->opt[CURLOPT_POSTFIELDS] = $this->post;
			}
			else
			{
				$numFields = count($this->post);
				$i = 0;
				$postFields = '';
				foreach ($this->post as $k=>$v)
				{
					$postFields .= $k.'='.$v;
					if ($i+1<$numFields) $postFields .= '&';
				}
				$this->opt[CURLOPT_POSTFIELDS] = $postFields;
			}
		}
	
		$this->opt[CURLOPT_FOLLOWLOCATION] = true;
		$this->opt[CURLOPT_FAILONERROR] = true;
		$this->opt[CURLOPT_MAXREDIRS] = 10;
		$this->opt[CURLOPT_RETURNTRANSFER] = true;
	
	
		if (!empty($this->proxy))
		{
			$this->opt[CURLOPT_HTTPPROXYTUNNEL] = true;
			$this->opt[CURLOPT_PROXY] = $this->proxy;
		}
	
		// All system ready...
		$ch = curl_init();
	
		// Set the cURL options
		curl_setopt_array($ch, $this->opt);
	
		// Make the request...
		$content = curl_exec($ch);
	
		// Get the error code (if any)
		$errno = curl_errno($ch);
	
		// Get the error msg (if any)
		$errmsg = curl_error($ch);
	
		// Get the response headers
		$header = curl_getinfo($ch);
	
		// Close the cURL session
		if ($close==true) curl_close($ch);
	
		$header['errno'] = $errno;
		$header['errmsg'] = $errmsg;
		$header['contents'] = $content;
	
		return $header;
	
	}
	
}


?>