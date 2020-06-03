<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:api="http://api.isap.com/">
   <soapenv:Header/>
   <soapenv:Body>
      <api:verify>
         <!--Optional:-->
         <arg0>
            <username><?= $username ?></username>
            <password><?= $password ?></password>

<?php foreach ($tags as $t => $v)  echo "\t\t<$t>$v</$t>\n" ?>

         </arg0>
      </api:verify>
   </soapenv:Body>
</soapenv:Envelope>