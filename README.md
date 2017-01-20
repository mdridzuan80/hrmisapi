# Hrmisapi

This is library for consume webservice with wss. Especialy Hrmis webservice.
Not for hrmis only but also can use another webservice with wss.

### Installation

Hrmisapi requires phpv5.3.+, php soap ext, php xml ext to run.

```sh
$ composer require mdridzuan80\hrmisapi
```

How to use in code.
```sh
<?php
    user Hrmisapi\Hrmisapi;
    $hrmis = new Hrmisapi(<webservice url>, <username>, <password>);
    
    //you must look Available webservice function in WSDL file
    $hrmis->GetUserInfo()->xml(); // Output in xml format
    $hrmis->GetUserInfo()->arr(); // Output in array format
?>
```
### Contact
Md Ridzuan bin Mohammad Latiah
md.ridzuan80@gmail.com
