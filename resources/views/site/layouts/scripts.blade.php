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

@if(Request::path() == 'plans' || Request::path() == '/')
<script>
  $('.button-label').click(function () {
    $('.card').removeClass('selected');
    $(this).parent().addClass('selected');
    var price = $('.selected option:selected').attr("price");
    var duration = $('.selected option:selected').attr("duration");
    $('.get_price').text('$'+price/100);
    $('.selected .coin').text( (price/duration/100).toFixed(2));
    if(price === '0'){
      $('.checkout').hide();
      $('.trial_start').show();
      $('#payment-form').attr('action', "{{ url('/getTrial') }}");
    }
    else {
      $('.checkout').show();
      $('.trial_start').hide();
    }
    $('section').show();
  });

  $('.select-options li').click(function () {
    let card = $(this).closest('.card');
    let price = card.find('option:selected').attr("price");
    let duration = card.find('option:selected').attr("duration");

    let coin = (price/duration/100).toFixed(2);

    $(this).closest('.card').find('.coin').text(coin);
    if (card.hasClass('selected')) $('.get_price').text('$' + price/100);
  });
</script>
@endif

@if(Request::path() == 'plans')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.js"></script>
    <script>
    $(document).ready(function(){
      $('.ncartao').mask('0000 0000 0000 0000');
      $('.mes').mask('00');
      $('.ano').mask('00');
      $('.ccv').mask('000');
    });
    </script>

    <script>
        $('.checkout .payment-item').click(function () {
            var action = $(this).find('.submit').val();
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

          var plan_id = $('.selected option:selected').attr("plan_id");
          $('.plan_id').attr('value', plan_id);

          $

          if ($form.attr('action') === "{{ url('/payWithstripe') }}") {
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

@if(Request::path() == 'send-us-an-email')
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
              $('#sendmessage').show();
                if (data.result) {
                    $('#sendmessage .errtext').text("@lang('contact_us.success')");
                }
                else {
                    $('#sendmessage .errtext').text("@lang('contact_us.failed')");
                }
            },
            error: function () {
                $('#sendmessage').show();
                $('#sendmessage .errtext').text("@lang('contact_us.failed')");
            }
        });
    });
</script>
@endif

@if(Request::path() == 'how-it-works')
<script>
  var resol = screen.width+'x'+screen.height;
  $('#screen_res').text(resol).removeAttr('id');
</script>
@endif

<script>

$('.modal-close').click(function(){
  $('.modal-content').remove();
  $('.modal').remove();
});

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
