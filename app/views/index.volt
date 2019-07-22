
<html>
<head>
        <meta http-equiv="Content-Security-Policy" content="default-src *; style-src 'self' http://* 'unsafe-inline'; script-src 'self' http://* 'unsafe-inline' 'unsafe-eval'" />

        

        <script type="text/javascript" language="javascript" src="//code.jquery.com/jquery-1.11.1.min.js"></script>

        {{ stylesheet_link('/assets/css/bootstrap.css') }}

        {{ stylesheet_link('/assets/css/bootstrap.min.css') }}

        {{ stylesheet_link('/assets/css/dataTables.bootstrap.css') }}

        {{ stylesheet_link('/assets/css/dataTables.bootstrap.css') }}

        {{ stylesheet_link('/assets/css/font-awesome.min.css') }}

        {{ stylesheet_link('/assets/css/font-awesome.css') }}
        
        {{ javascript_include("/assets/js/datatables.js") }}
    </head>
<body>
<div class="wrapper">
    
    {{ content() }}
</div>
{% if sentry_dsn is defined %}
    <script src="https://cdn.ravenjs.com/3.14.2/raven.min.js"></script>
    <script>
        var appDSN = "{{ sentry_dsn }}";
        //Raven.config(appDSN).install();
        {% if error is defined %}
        Raven.showReportDialog({
            eventId : "{{ errorid }}",
            dsn : appDSN
        });
        {% endif %}
    </script>
{% endif %}
<!-- Hotjar Tracking Code for https://aplikasi.kirim.email -->
<script>
    (function(h,o,t,j,a,r){
        h.hj=h.hj||function(){(h.hj.q=h.hj.q||[]).push(arguments)};
        h._hjSettings={hjid:502156,hjsv:5};
        a=o.getElementsByTagName('head')[0];
        r=o.createElement('script');r.async=1;
        r.src=t+h._hjSettings.hjid+j+h._hjSettings.hjsv;
        a.appendChild(r);
    })(window,document,'//static.hotjar.com/c/hotjar-','.js?sv=');
</script>
</body>
</html>
