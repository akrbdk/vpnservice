
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="{{ asset('site/js/vendor.min.js') }}"></script>
<script src="{{ asset('site/js/main.min.js') }}"></script>


@if(Request::path() == 'contact-us')
    <script>
        $("#faq .list > li").click( function(){
            $("#faq .list > li").removeClass('active');
            $(this).addClass('active');
        });
    </script>
@endif

@if(Request::path() == 'plans')
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
        $('.btn-send').click(function(e){
            e.preventDefault();

            $.ajax({
                type: 'POST',
                url: '/plan',
                data: "plan_id="+$(this).prop('id'),
                success: function (data){
                    if(data.ret)
                    {
                        alert('Successfull subscribed');
                    }
                    else
                    {
                        alert('Error subscribe');
                    }
                },
                error: function() {
                    alert('Error subscribe');
                }
            });

            return false;
        });
    </script>
@endif

@if(Request::path() == 'send-us-an-email' || Request::path() == 'invites' || Request::path() == 'new-password')
    <script>
        var clipboard = new Clipboard('.btn-cpy');
    </script>
@endif

@if(Request::path() == 'change-password' || Request::path() == 'customer-area')
    <script>
        var modal = function(){
            $(".modal, .modal-content").show();
        }

        $(".modal").click( function(){
            $(".modal, .modal-content").hide();
        });
    </script>
@endif

<script>
    $('#contactform').submit(function(e){
        e.preventDefault();

        var formData = new FormData(this);
        console.log(formData);

        $.ajax({
            type: 'POST',
            url: '/sendmail',
            data: formData,
            cache:false,
            contentType: false,
            processData: false,
            success: function(data){
                if(data.result)
                {
                    $('#senderror').hide();
                    $('#sendmessage').show();
                }
                else
                {
                    $('#senderror').show();
                    $('#sendmessage').hide();
                }
            },
            error: function(){
                $('#senderror').show();
                $('#sendmessage').hide();
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
