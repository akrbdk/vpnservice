<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="{{ asset('site/js/vendor.min.js') }}"></script>
<script src="{{ asset('site/js/main.min.js') }}"></script>


@if(Request::path() == 'contact-us')
    <script>
        $("#faq .list > li").click(function () {
            $("#faq .list > li").removeClass('active');
            $(this).addClass('active');
        });
    </script>
@endif

@if(Request::path() == 'plans')
    <script>
    $('label.btn-orange').click(function(){
        $('.checkout').hide();
        $('#payment-form').attr('action', "{{ url('/getTrial') }}");
        $('.trial_start').show();
    });
    $('label.btn-green').click(function(){
        $('.checkout').show();
        $('.trial_start').hide();
    });
    </script>

    <script>
        $('.checkout .payment-item').click(function () {
            var action = '<?php echo url('/');?>/payWith' + $(this).find('.submit').val();
            $('#payment-form').attr('action', action);
            $('.checkout .payment-item').removeClass('active');
            $('.checkout .payment-item').find('input').removeAttr('required');
            $(this).addClass('active');
            $(this).find('input').prop('required',true);
        });


        $('.cupom').click(function () {
            $('.cupom').removeClass('active');
            $(this).addClass('active');
        });
    </script>

    <script type="text/javascript" src="https://js.stripe.com/v2/"></script>

    <script>

    Stripe.setPublishableKey('pk_test_fKqH3Umcg7ShY0jgF6qYaOYY');

    $(function() {
      var $form = $('#payment-form');
        $form.submit(function(event) {
          if ($form.attr('action') === '<?php echo url('/');?>/payWithstripe') {
            $form.find('.submit').prop('disabled', true);

             Stripe.card.createToken($form, stripeResponseHandler);
          }
          else {
            $form.get(0).submit();
          }
          return false;
        });
    });

    function stripeResponseHandler(status, response) {

      var $form = $('#payment-form');

      if (response.error) {

        $form.find('.payment-errors').text(response.error.message);
        $form.find('.submit').removeAttr('disabled');

      } else {

        var token = response.id;

        $form.append($('<input type="hidden" name="stripeToken">').val(token));

        $form.find('.submit').removeAttr('disabled');

        $form.get(0).submit();
      }
    };
    </script>
@endif

@if(Request::path() == 'send-us-an-email' || Request::path() == 'invites' || Request::path() == 'new-password')
    <script>
        var clipboard = new Clipboard('.btn-cpy');
    </script>
@endif

@if(Request::path() == 'change-password' || Request::path() == 'customer-area')
    <script>
        var modal = function () {
            $(".modal, .modal-content").show();
        }

        $(".modal").click(function () {
            $(".modal, .modal-content").hide();
        });
    </script>
@endif

<script>
    $('#contactform').submit(function (e) {
        e.preventDefault();

        var formData = new FormData(this);
        console.log(formData);

        $.ajax({
            type: 'POST',
            url: '/sendmail',
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: function (data) {
                if (data.result) {
                    $('#senderror').hide();
                    $('#sendmessage').show();
                }
                else {
                    $('#senderror').show();
                    $('#sendmessage').hide();
                }
            },
            error: function () {
                $('#senderror').show();
                $('#sendmessage').hide();
            }
        });
    });
</script>

@if(Request::path() == 'how-it-works')
<script>
  var resol = screen.width+'x'+screen.height;
  $('#screen_res').text(resol).removeAttr('id');
</script>
@endif

<script>
    (function (b, o, i, l, e, r) {
        b.GoogleAnalyticsObject = l;
        b[l] || (b[l] =
            function () {
                (b[l].q = b[l].q || []).push(arguments)
            });
        b[l].l = +new Date;
        e = o.createElement(i);
        r = o.getElementsByTagName(i)[0];
        e.src = 'http://www.google-analytics.com/analytics.js';
        r.parentNode.insertBefore(e, r)
    }(window, document, 'script', 'ga'));
    ga('create', 'UA-XXXXX-X');
    ga('send', 'pageview');
</script>
