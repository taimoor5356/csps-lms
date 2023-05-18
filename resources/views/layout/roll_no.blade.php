<script>
    $(document).on('change', '#applied_for', function () {
        if ($(this).val() == 'written') {
            $('#written-exam-type').removeClass('d-none');
            $('#interview-type').addClass('d-none');
        } else if ($(this).val() == 'interview') {
            $('#written-exam-type').addClass('d-none');
            $('#interview-type').removeClass('d-none');
        } else {
            $('#written-exam-type').addClass('d-none');
            $('#interview-type').addClass('d-none');
        }
    });
    $(document).on('keyup', '#reg-no', function() {
        $('#roll-no1').val($(this).val());
    });
    $(document).on('change', '#css-pms-yr', function() {
        $('#reg-no2').val($(this).val());
        let cssPmsYr = $(this).val();
        $.ajax({
            url: "{{ route('fetch_batch_nos') }}",
            type: "POST",
            data: {
                _token: "{{ csrf_token() }}",
                year_id: cssPmsYr
            },
            success: function(response) {
                $('#batch-no').html('');
                if (response.status == true) {
                    var html =
                        "<option value='' disabled selected>Select Batch No</option>";
                    let batches = response.batch_nos.forEach(ele => {
                        html += `
                            <option value="` + ele.id + `">` + ele.batch + `</option>
                        `;
                    });
                    $('#batch-no').html(html);
                }
            }
        });
    });
    $(document).on('change', '#batch-no', function() {
        let _this = $(this);
        let year = $('#css-pms-yr').val();
        $('#reg-no3').val(_this.val());
        $.ajax({
            type: "POST",
            url: "{{ route('lastregistrationnumber') }}",
            data: {
                _token: "{{ csrf_token() }}",
                year_id: year,
                batch_id: _this.val(),
            },
            success: function(response) {
                $('#reg-no').val('');
                if (response.status == true) {
                    $('#reg-no').val(response.registration_number);
                    setTimeout(() => {
                        $('#roll-no').val('');
                        var cssPmsYr = $('#css-pms-yr').find('option:selected')
                            .html();
                        var batchNo = $('#batch-no').find('option:selected').html();
                        if (cssPmsYr == null) {
                            cssPmsYr = '';
                        } else {
                            cssPmsYr = cssPmsYr.replaceAll('_', '-');
                        }
                        if (batchNo == null) {
                            batchNo = '';
                        }
                        if (response.registration_number != "") {
                            $('#roll-no').val(response.registration_number + '-' +
                                cssPmsYr + '-' + batchNo);
                        } else {
                            $('#roll-no').val('' + '-' +
                                '' + '-' + '');
                        }
                    }, 500);
                }
            }
        });
    
    });
    $(document).on('keyup change', '#paying-fee', function() {
        let totalFee = $(this).val();
        $('#paid-fee').val(totalFee);
    });
</script>