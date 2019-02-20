
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="{{ asset('site/js/vendor.min.js') }}"></script>
<script src="{{ asset('site/js/main.min.js') }}"></script>
<script>
    $('.modal-close').click(function(){
      $('.modal-content').remove();
      $('.modal').remove();
    });
    var modal = function(){
        $(".modal, .modal-content").show();
    }

    $('#reset_email_submit').on('submit', function(e){
        e.preventDefault();
        $(".forgot").hide();
        $.ajax({
            url: "password/email",
            data: {
                _token: document.querySelector('input[name="_token"]').value,
                email: document.querySelector('input[name="email"]').value
            },
            type: "POST",
            success: function() {
              $('#sendmessage').show();
                $('#sendmessage .errtext').text("Successful : link send");
            },
            error: function(e) {
              $('#sendmessage').show();
                $('#sendmessage .errtext').text("Faild: link not send");
            }
        });

    });
</script>

<script>
    (function(b,o,i,l,e,r){b.GoogleAnalyticsObject=l;b[l]||(b[l]=
        function(){(b[l].q=b[l].q||[]).push(arguments)});b[l].l=+new Date;
        e=o.createElement(i);r=o.getElementsByTagName(i)[0];
        e.src='http://www.google-analytics.com/analytics.js';
        r.parentNode.insertBefore(e,r)}(window,document,'script','ga'));
    ga('create','UA-XXXXX-X');ga('send','pageview');
</script>
