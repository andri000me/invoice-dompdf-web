<?php
ob_start();
?>
<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <title>A simple, clean, and responsive HTML invoice template</title>

    <style>
        .invoice-box {
            max-width: 800px;
            margin: auto;
            padding: 30px;
            border: 1px solid #eee;
            box-shadow: 0 0 10px rgba(0, 0, 0, .15);
            font-size: 16px;
            line-height: 24px;
            font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
            color: #555;
        }

        .invoice-box table {
            width: 100%;
            line-height: inherit;
            text-align: left;
        }

        .invoice-box table td {
            padding: 5px;
            vertical-align: top;
        }

        .invoice-box table tr td:nth-child(2) {
            text-align: right;
        }

        .invoice-box table tr.top table td {
            padding-bottom: 20px;
        }

        .invoice-box table tr.top table td.title {
            font-size: 45px;
            line-height: 45px;
            color: #333;
        }

        .invoice-box table tr.information table td {
            padding-bottom: 40px;
        }

        .invoice-box table tr.heading td {
            background: #eee;
            border-bottom: 1px solid #ddd;
            font-weight: bold;
        }

        .invoice-box table tr.details td {
            padding-bottom: 20px;
        }

        .invoice-box table tr.item td {
            border-bottom: 1px solid #eee;
        }

        .invoice-box table tr.item.last td {
            border-bottom: none;
        }

        .invoice-box table tr.total td:nth-child(2) {
            border-top: 2px solid #eee;
            font-weight: bold;
        }

        @media only screen and (max-width: 600px) {
            .invoice-box table tr.top table td {
                width: 100%;
                display: block;
                text-align: center;
            }

            .invoice-box table tr.information table td {
                width: 100%;
                display: block;
                text-align: center;
            }
        }

        /** RTL **/
        .rtl {
            direction: rtl;
            font-family: Tahoma, 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
        }

        .rtl table {
            text-align: right;
        }

        .rtl table tr td:nth-child(2) {
            text-align: left;
        }
    </style>
</head>

<body>
    <div class="invoice-box">
        <table cellpadding="0" cellspacing="0">
            <tr class="top">
                <td colspan="2">
                    <table>
                        <tr>
                            <td class="title">
                                <img src="http://localhost/sss/assets/logo.png" style="width:100%; max-width:300px;">
                            </td>

                            <td>
                                <?php
                                $sql_invoice = 'SELECT * FROM invoice';
                                $query_invoice = mysqli_query($conn, $sql_invoice);
                                $row_invoice = mysqli_fetch_array($query_invoice);
                                print "Invoice #: " . $row_invoice["id"];
                                print "<br>" . $row_invoice["date"];
                                ?>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>

            <tr class="information">
                <td colspan="2">
                    <table>
                        <tr>
                            <td>
                                CV. Stech Dawn<br>
                                Jakarta Selatan<br>
                            </td>

                            <td>
                                Pembeli<br>
                                <?php
                                print $row_invoice["buyer"];
                                ?>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>

            <?php
            $sql_item_detail = 'SELECT * FROM detail_item';
            $query_item_detail = mysqli_query($conn, $sql_item_detail);
            while ($row_item_detail = mysqli_fetch_array($query_item_detail)) {
                print '
                <tr class="item">
                <td>'
                    . $row_item_detail["name"] . ' 
                </td>
                <td>'
                    . "$" . $row_item_detail["price"] . '
                </td>
            </tr>
                ';
            }
            ?>

            <tr class="total">
                <td></td>

                <td>
                    <?php
                    print "Total: $" . $row_invoice["total_price"];
                    ?>
                </td>
            </tr>
        </table>
    </div>
</body>

</html>
<?php
$html = ob_get_clean();
