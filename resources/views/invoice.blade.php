
@extends('layouts.app2')

@section('content')
    <div class="container">
        <form method="post" action="{{route('invoice')}}" enctype="multipart/form-data">
          {{ csrf_field() }}
        <div class="row">
            <div class="col-md-8 col-md-offset-2">

                    <div class="col-md-12">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Provider name</label>
                                <input type="text" class="form-control" id="provider_name" name="provider_name" placeholder="Type Provider name">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Participate name</label>
                                <input type="text" class="form-control" id="participate_name" name="participate_name" placeholder="Type participate name">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Invoice number</label>
                                <input type="number" class="form-control" id="invoice_number" name="invoice_number" >
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Invoice Date</label>
                                <input type="date" class="form-control" id="invoice_date" name="invoice_date" >
                            </div>
                        </div>
                    </div>

            </div>
        </div>
            <div id="additem">
                <div class="row ">
                    <div class="col-md-1">start date</div>
                    <div class="col-md-1">end date</div>
                    <div class="col-md-1">credit term</div>
                    <div class="col-md-1">Active</div>
                    <div class="col-md-1">Support number</div>
                    <div class="col-md-2">Descripiton</div>
                    <div class="col-md-1">Unit</div>
                    <div class="col-md-1">Price</div>
                    <div class="col-md-1">Gst Code</div>
                    <div class="col-md-1">Gst Amount</div>
                </div>
            </div>
            <div class="row mt-10">
                <div>
                    <a id="add_more_item" class="btn-block"> Add item </a>
                    <div>
                        <input type="file" id="invoice upload" name="invoice_upload">
                    </div>

                    <div>
                        <input type="text" name="total" value="0" id="total">
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
            <input type="hidden" value="0" id="count_add_item" name="count_add_item">
        </form>
    </div>

    <script>
        jQuery(document).ready(function () {
            var count = 1;
            jQuery('#add_more_item').click(function () {
                var id_item = 'add_more_item_'+count;
                count = count +1;
                var additem = '<div class="row row_add_item invoice_list" id="'+id_item+'">' +
                    '    <div class="col-md-1"><input type="date" name="s_date[]" required></div>' +
                    '    <div class="col-md-1"><input type="date" name = "end_date[]" required></div>' +
                    '    <div class="col-md-1"><input type="number" name = "c_term[]" required></div>' +
                    '    <div class="col-md-1"><input type="checkbox" name = "active[]" value="1" required></div>' +
                    '    <div class="col-md-1"><input type="number" name = "s_no[]" required></div>' +
                    '    <div class="col-md-2"><input type="text" name = "desc[]" required></div>' +
                    '    <div class="col-md-1"><input type="number" class="unit_item" in="1" name = "unit[]" value="1"  onkeyup="updateAMount(this)" required></div>' +
                    '    <div class="col-md-1"><input type="number" class="price_item" name = "price[]"  value="0" onkeyup="updateAMount(this)" required></div>' +
                    '    <div class="col-md-1"><input type="number"  class="gst_item" min="1" name = "gst_code[]" value="0" onkeyup="updateAMount(this)" required></div>' +
                    '    <div class="col-md-1"><input type="text" name = "amount[]" value="0" class="amount_item" ed></div>' +
                    '    <div class="col-md-1 border-none "> <a  class="delete_item" onclick="removeDiv(this)" ">delete</a> </div>' +
                    '</div>';
                jQuery('#additem').append(additem);
                jQuery('#count_add_item').val(jQuery('.invoice_list').length)
            });
        });
        function removeDiv(elem){
            $(elem).parent().parent('div').remove();
            jQuery('#count_add_item').val(jQuery('.invoice_list').length)
        }
        function updateAMount(elem) {
           var unit = parseInt( $(elem).parent().parent().find('.unit_item').val());
           var price = parseInt($(elem).parent().parent().find('.price_item').val())  ;
           var gst = parseInt($(elem).parent().parent().find('.gst_item').val());
           var amount = 0;
           if(price > 0){
                amount = price * unit;
                if(gst > 0){
                    amount = amount+((amount  * gst)/100);
                }
            }

            $(elem).parent().parent().find('.amount_item').val(amount)
            totalsum();
        }

        function totalsum(){
            var ek= 0;
            $('.amount_item').each(function() {
                // ek.push();
               ek= ek + parseFloat($(this).val());
            });
            $('#total').val(ek);
        }
    </script>
@endsection




