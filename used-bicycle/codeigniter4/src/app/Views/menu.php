<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<title>中古車販売メニュー</title>
	<meta name="description" content="中古車売ってますよ！">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.css">
    <script src="js/jquery-3.5.1.js"></script>
	<script src="js/bootstrap.js"></script>
</head>
<body>
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="#">中古車販売メニュー</a>
        </nav>
        <div class="my-4">
            <div class="mr-4" style="display: inline;" id="register">
                <button type="button" class="btn btn-primary">新規登録</button>
            </div>
            <div class="mr-4" style="display: inline;" id="sales-amount">
                <button type="button" class="btn btn-primary">売上確認</button>
            </div>
        </div>

        <div class="alert-area"></div>

        <table class="table table-hover car-info">
            <thead>
                <tr>
                <th scope="col">#</th>
                <th scope="col">車種</th>
                <th scope="col">値段</th>
                <th scope="col">色</th>
                <th scope="col">備考</th>
                <th scope="col"></th>
                </tr>
            </thead>
            <tbody>

            </tbody>
        </table>

        <div class="load"></div>
    </div>
</body>
<script>
    $(function() {
        //------------------------------------------------------------------
        // 中古車一覧
        //------------------------------------------------------------------
        $.get('cars', function(cars) {
            if (cars.length === 0) {
                return;
            }

            for (var i = 0; i < cars.length; i++) {
                let car = cars[i];
                addRow(car);
            }
        });

        //------------------------------------------------------------------
        // 新規登録
        //------------------------------------------------------------------
        $('div#register > button').on('click', function() {
            $('div.load').load('modal/register.html', function() {
                $('div#register-modal').modal();
            });
        });

        $(document).on('click', 'div.modal-footer > button.btn-save', function() {
            $.post({
                url: 'cars',
                data: $(this).closest('form').serializeArray(),
            })
            .done(function(res) {
                console.log(res);
                if (res.status === 422) {
                    let messages = res.messages.validation;

                    $('input#type').next().remove();
                    $('input#price').next().remove();
                    $('input#color').next().remove();

                    if (messages.type !== undefined) {
                        $('input#type').closest('div.form-group').append(
                            $('<div>')
                                .addClass('alert')
                                .addClass('alert-danger')
                                .addClass('mt-2')
                                .text(messages.type)
                        );
                    }
                    if (messages.price !== undefined) {
                        $('input#price').closest('div.form-group').append(
                            $('<div>')
                                .addClass('alert')
                                .addClass('alert-danger')
                                .addClass('mt-2')
                                .text(messages.price)
                        );
                    }
                    if (messages.color !== undefined) {
                        $('input#color').closest('div.form-group').append(
                            $('<div>')
                                .addClass('alert')
                                .addClass('alert-danger')
                                .addClass('mt-2')
                                .text(messages.color)
                        );
                    }

                } else if (res.status === 201) {
                    $('div#register-modal').modal('hide');
                    $('div.alert-area').load('modal/alert-success.html', function() {
                        let text = $('div.alert-success > span').text();
                        $('div.alert-success > span').text(text.replace(/{text}/, '新規登録が完了しました。'));

                        addRow(res.data);
                    });
                } else {
                    $('div#register-modal').modal('hide');
                    $('div.alert-area').load('modal/alert-failure.html', function() {
                        let text = $('div.alert-failure > span').text();
                        $('div.alert-failure > span').text(text.replace(/{text}/, '新規登録に失敗しました。'));
                    });
                }
            })
            .fail(function(jqXHR, textStatus, errorThrown) {
                $('div.alert-area').load('modal/alert-failure.html', function() {
                    console.log(jqXHR);
                    console.log(textStatus);
                    console.log(errorThrown);
                });
            });
        });

        $(document).on('shown.bs.modal', 'div#register-modal', function() {
            $('input#type').trigger('focus');
        });

        $(document).on('hidden.bs.modal', function() {
            $('div#register-modal').remove();
        });

        //------------------------------------------------------------------
        // 売上確認
        //------------------------------------------------------------------
        $('div#sales-amount > button').on('click', function() {
            $('div.load').load('modal/sales-amount.html', function() {
                $.get('salesAmount', function(res) {
                    let text = $('.modal-body > label').text();
                    $('.modal-body > label').text(text.replace(/{salesAmount}/, res.salesAmount));
                    $('div#sales-amount-modal').modal();
                });
            });
        });

        $(document).on('hidden.bs.modal', function() {
            $('div#sales-amount-modal').remove();
        });

        //------------------------------------------------------------------
        // 購入
        //------------------------------------------------------------------
        $(document).on('click', 'button.btn-buy-confirmation', function() {
            let id = $(this).closest('td').next().val();
            $('div.load').load('modal/buy-confirmation.html', function() {
                $.get('cars/' + id, function(res) {
                    $('div#buy-confirmation-modal').find('[name=id]').val(id);
                    $('div#buy-confirmation-modal').modal();
                });
            });
        });

        $(document).on('click', 'div.modal-footer > button.btn-buy', function() {
            let id = $(this).closest('form').find('[name=id]').val();
            $.ajax({
                type: 'PUT',
                url: 'cars/' + id,
                data: $(this).closest('form').serializeArray(),
                datatype: 'json',
            })
            .done(function(res) {
                if (res.status === 200) {
                    // 該当商品の行を削除する
                    $('input[type=hidden]').each(function() {
                        if ($(this).val() === id) {
                            $(this).closest('tr').remove();
                            return false;
                        }
                    });

                    // 番号（#）を振り直し
                    $('td.number').each(function(index) {
                        $(this).text(index + 1);
                    });

                    $('div#buy-confirmation-modal').modal('hide');

                    $('div.alert-area').load('modal/alert-success.html', function() {
                        let text = $('div.alert-success > span').text();
                        $('div.alert-success > span').text(text.replace(/{text}/, '購入が完了しました。'));
                    });
                } else {
                    $('div#buy-confirmation-modal').modal('hide');
                    $('div.alert-area').load('modal/alert-failure.html', function() {
                        let text = $('div.alert-failure > span').text();
                        $('div.alert-failure > span').text(text.replace(/{text}/, '購入に失敗しました。'));
                    });
                }
            })
            .fail(function(jqXHR, textStatus, errorThrown) {
                $('div.alert-area').load('modal/alert-failure.html', function() {
                    console.log(jqXHR);
                    console.log(textStatus);
                    console.log(errorThrown);
                });
            });
        });

        $(document).on('hidden.bs.modal', function() {
            $('div#buy-confirmation-modal').remove();
        });


        //------------------------------------------------------------------
        // 共通
        //------------------------------------------------------------------
        function addRow(car) {
            let $btnBuy = $('<button>')
                            .attr('type', 'button')
                            .addClass('btn')
                            .addClass('btn-primary')
                            .addClass('btn-buy-confirmation')
                            .text('購入')
            ;
            let $tdBtnBuy = $('<td>').append($btnBuy);

            let number = currentNumber() + 1;
            let $tdNumber = $('<td>').append(number).addClass('number').data('value', number);
            let $tdType = $('<td>').append(car.type).addClass('type').data('value', car.type);
            let $tdPrice = $('<td>').append(car.price).addClass('price').data('value', car.price);
            let $tdColor = $('<td>').append(car.color).addClass('color').data('value', car.color);
            let $tdRemark = $('<td>').append(car.remark).addClass('remark').data('value', car.remark);
            let $hiddenId = $('<input>').attr('type', 'hidden').val(car.id);

            let $tr = $('<tr>')
                        .append($tdNumber)
                        .append($tdType)
                        .append($tdPrice)
                        .append($tdColor)
                        .append($tdRemark)
                        .append($tdBtnBuy.clone())
                        .append($hiddenId)
            ;

            $('tbody').append($tr);
        }

        function currentNumber() {
            var currentNumber = 0;
            $('table.car-info').find('td.number').each(function() {
                var n = $(this).data('value');
                currentNumber = currentNumber < n ? n : currentNumber;
            });
            return currentNumber;
        }
    });
</script>
</html>
