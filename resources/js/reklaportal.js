$(function(){

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('#scanInvoiceNumberOrderRef').on('input', function () {

        let search = $(this).val();

        $('#loader').removeClass('d-none');

        $.ajax({
            method: "POST",
            url: "getOrderData",
            data: { "search": search},
            success : function (data) {
                if(data.success){
                    successSearchOrder(data);
                }else{
                    $('#content_info').removeClass('d-none');
                    $('#orderContent').html('');
                    $('#content_info').html(`<p>${data.message}</p>`);
                    $('#scanInvoiceNumberOrderRef').val('');
                }
                $('#loader').addClass('d-none');
            }
        })
    });

    function scanEan(ean) {
        let orderItem = $("tr[data-ean="+ean+"]");
        if(orderItem){
            orderItem.css("backgroundColor","#70ad47");
        }
        setTimeout(()=>{
            $('#scanEan').val('');
        },300);
    }


    function successSearchOrder(data){
        $('#main-container').html(data.view);
        $('#content_info').addClass('d-none');

        $('#scanEan').focus().on('input',function () {
            scanEan($(this).val())
        });

        $('.retoure').on('click',function () {
            $('.orderData-modal').addClass('showOrderDataModal');
            $('.retoure').addClass('active-blue-button');
        });

        $('.orderData-modal-close, .orderData-modal-btn-no, .orderData-modal-email-close').on('click',function () {
            $('.orderData-modal, .orderData-modal-email').removeClass('showOrderDataModal');
            $('.retoure').removeClass('active-blue-button');
        });

        $('.orderData-modal-btn-no').on('click',function () {
            $('.retoure').addClass('active-blue-button');
            $('.orderData-modal-email').addClass('showOrderDataModal');
        });

        $('.orderData-modal-btn-yes').on('click',function () {
            retoure();
        });

        $('.send-email-btn').on('click',function () {
            $('.send-email-btn').attr("disabled", true);
            $('#loader').removeClass('d-none');
            sendEmail();
        });

        $('.reklamation').on('click',function () {
            $('.orderdata-garantie-service').toggle();
            $('.reklamation').toggleClass('active-blue-button');
        });

        $('#service').on('click',function () {
            (($("#category4:checked").is(':checked'))) ? $("#category1").prop("checked",true) : "";
            $('.typeD').hide();
            $('#kundensupport').parent().removeClass("d-none");
        });

        $('#garantie').on('click',function () {
            $('.typeD').show();
            $('#kundensupport').parent().addClass("d-none");
        });

        $('#zuruck').on('click',function () {
            goLastScreen();
        });

    }
    
    
    function sendEmail() {

        let subject = $('#orderRef').text();
        let mailBody = $('.mailBody').val();

        $.ajax({
            method: "POST",
            url: "sendCustomerSupportMail",
            data: { "subject": subject,"mailBody":mailBody},
            success : function (data) {
                $('.orderData-modal-email').removeClass('showOrderDataModal');
                $('.retoure').removeClass('active-blue-button');
                $('.send-email-btn').attr("disabled", false);
                $('#loader').addClass('d-none');
            }
        })

    }

    function retoure() {console.log('asdsaasd');
        $('#loader').removeClass('d-none');
        let orderRef = $('#orderRef').text();
        $.ajax({
            method: "POST",
            url: "retoure",
            data: { "orderRef": orderRef},
            success : function (data) {

                $('.orderData-modal').removeClass('showOrderDataModal');
                $('#loader').addClass('d-none');

                if(data.success){
                    console.log("true");
                }else{
                    console.log("false");
                }

            }
        })
    }

    function goLastScreen() {
        $('.orderdata-garantie-service').hide();
        $('.reklamation').removeClass('active-blue-button');
        $('.orderItem').css("backgroundColor","");
    }

});