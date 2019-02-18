
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="{{ asset('site/js/vendor.min.js') }}"></script>
<script src="{{ asset('site/js/main.min.js') }}"></script>

<script>
    $('.checkout .payment-item').click( function(){
        $('.checkout .payment-item').removeClass('active');
        $(this).addClass('active');
    });

    $('.cupom').click( function(){
        $('.cupom').removeClass('active');
        $(this).addClass('active');
    });
</script>

<script>
    $('.modal-close').click(function(){
      $('.modal-content').remove();
      $('.modal').remove();
    });
    $('.btn-send').click(function(e){
        e.preventDefault();

        $.ajax({
            type: 'POST',
            url: '/plan',
            data: "plan_id="+$(this).prop('id'),
            success: function (data){
                    alert(data.ret);
            },
            error: function() {
                alert('Error subscribe');
            }
        });

        return false;
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
