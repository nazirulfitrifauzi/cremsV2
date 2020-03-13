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

        table {
  
         border-collapse: collapse;
         width: 100%;
         
        
        }
    </style>
</head>
<body>
    <main>
        <table border="0" width="100%">
            <tr>
                <th rowspan="3" width="20%"><img src="{{ public_path('argon/img/brand/csc_blue.png') }}" height="60px"></th>
                <th colspan="2"></th>
            </tr>
            <tr>
                <td width="1%"></td>
                <td valign="middle"><h1>REPAYMENT SCHEDULE</h1></td>
            </tr>
            <tr>
                <td colspan="2"></td>
            </tr>
        </table>
        <br>
       
       
        <table style="color:black" width="100%" border="1px" >
            <thead>
                <tr bgcolor="#D3D3D3" >
                    <td><b>MONTH</b></td>
                    <td align="right"><b>INSTALLMENT </b></td>
                </tr>
            </thead>
            <tbody>
                @foreach ($content['months'] as $month)
                    <tr>
                        <td>{{$month}}</td>
                        <td align="right">{{ number_format($deduct,2) }}<br><br></td>
                       
                    </tr>
                @endforeach
                <tr>
                    <td>{{$last_month}}</td>
                    <td  align="right">{{ number_format($last_deduct,2) }} <br><br></td>
                </tr>
            </tbody>
            
        </table>

        <h3>AMOUNT: {{$amt}}</h3>
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
