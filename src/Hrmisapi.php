<?php
//usage
// $api = Hrmisapi("https://perkongsiandata.eghrmis.gov.my/wsintegrasi/dataservice.asmx","username","password");
// $api->GetDataLeaveFileByDate(["tarikh"=>"yyyy-mm-dd","buorgchart"=>1234])->array();
namespace Hrmisapi;

use Hrmisapi\Components\XML2Array;

class Hrmisapi
{
    private $_url;
    private $_username;
    private $_password;
    private $_options;
    private $_client;

    public function __construct($url, $username, $password)
    {
        $this->_url = $url;
        $this->_username = $username;
        $this->_password = $password;
        // Or 'soap_version' => SOAP_1_1 if your using SOAP 1.1
		$this->_options = array(
			'uri' => $url,
			'soap_version' => SOAP_1_2,
			'trace' => 1);
    }

    private function _client()
    {
        $this->_client = new \SoapClient($this->_url . "?WSDL", $this->_options);
    }

    private function _wssToken()
    {
		$wssNamespace = "http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-secext-1.0.xsd";
		$username = new \SoapVar($this->_username,
								XSD_STRING,
								null, null,
								'Username',
								$wssNamespace);
		$password = new \SoapVar($this->_password,
								XSD_STRING,
								null, null,
								'Password',
								$wssNamespace);
		$usernameToken = new \SoapVar(array($username, $password),
										SOAP_ENC_OBJECT,
										null, null, 'UsernameToken',
										$wssNamespace);
		$usernameToken = new \SoapVar(array($usernameToken),
								SOAP_ENC_OBJECT,
								null, null, null,
								$wssNamespace);
		$wssUsernameTokenHeader = new \SoapHeader($wssNamespace, 'Security', $usernameToken);
		$this->_client->__setSoapHeaders($wssUsernameTokenHeader);
    }

    //param 1 (text) : webservice function available
    //param 2 (array) : field argument
    public function __call($name, $arguments)
    {
        try
        {
            $this->_client();
            $this->_wssToken();
            $this->_client->{$name}($arguments[0]);
            return $this;
        }
        catch(Exception $e)
        {
            die($e);
        }
    }

    // Output type : 'xml'
    public function xml()
    {
        return $this->_client->__getLastResponse();
    }

    // Output type : 'array'
    public function arr()
    {
        return XML2Array::createArray(str_replace('>', '>',
												str_replace('<', '<',
													str_replace('&', '&',
														$this->_client->__getLastResponse())))); 
    }
}
