<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>{{$title}}</title>
    <style>
        /**
            Set the margins of the page to 0, so the footer and the header
            can be of the full height and width !
        **/
        @page {
            margin: 30px 80px 40px 80px;
        }
    
        /** Define now the real margins of every page in the PDF **/
        body {
            font-family: 'Roboto', sans-serif;
            font-weight: 400; font-size: 12px;
            line-height: 1.4;
        }
        main{
            page-break-inside: auto;
        }
        .contentSection {
            font-size: 12px;
            line-height: 1.4;
        }
        .tab {
            padding-left:4em
        }
        hr.signature {
            border-top: 2px dotted black;
        }
        .textCenter {
            text-align: center;
        }
        .page-break {
            page-break-after: always;
        }
    </style>
</head>
<body>
    <main>
        <h1>Repayment Schedule</h1>
        <h3>Amount: {{$amt}}</h3>
        <table>
            <thead>
                <tr>
                    <td>Month</td>
                    <td>Installment</td>
                </tr>
            </thead>
            <tbody>
                @foreach ($content['months'] as $month)
                    <tr>
                        <td>{{$month}}</td>
                        <td>{{ number_format($deduct,2) }}</td>
                    </tr>
                @endforeach
                <tr>
                    <td>{{$last_month}}</td>
                    <td>{{ number_format($last_deduct,2) }}</td>
                </tr>
            </tbody>
            
        </table>
    </main>

    <script type="text/php">
        if ( isset($pdf) ) {
            $x = 200;
            $y = 800;
            $text = "*** This is a computer-generated document. No signature is required. ***";
            $font = $fontMetrics->get_font("helvetica", "bold");
            $size = 6;
            $color = array(0,0,0);
            $word_space = 0.0;  //  default
            $char_space = 0.0;  //  default
            $angle = 0.0;   //  default
            $pdf->page_text($x, $y, $text, $font, $size, $color, $word_space, $char_space, $angle);
        }
    </script>
</body>
</html>
