<?php
    $dynamic_app = getenv('DYNAMIC_APP');
	$static_app = getenv('STATIC_APP');
	$static_app_premium = getenv('STATIC_APP_PREMIUM');
?>
<VirtualHost *:80>
        ServerName demo.api.ch
		
		ProxyRequests Off
		ProxyPreserveHost On
		
		Header add Set-Cookie "ROUTEID=.%{BALANCER_WORKER_ROUTE}e; path=/" env=BALANCER_ROUTE_CHANGED
		
		<Proxy balancer://dynamicApp>
        BalancerMember 'http://<?php print "$dynamic_app"?>'
		</Proxy>
		
		<Proxy balancer://staticApp>
        BalancerMember 'http://<?php print "$static_app"?>' route=1
        BalancerMember 'http://<?php print "$static_app_premium"?>' route=2

        ProxySet lbmethod=byrequests
        ProxySet stickysession=ROUTEID
		</Proxy>

        ProxyPass '/api/students/' 'balancer://dynamicApp/'
        ProxyPassReverse '/api/students/' 'balancer://dynamicApp/'

        ProxyPass '/' 'balancer://staticApp/'
        ProxyPassReverse '/' 'balancer://staticApp/'
</VirtualHost>