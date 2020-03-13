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
        <table border="0" width="100%">
            <tr>
                <th rowspan="3" width="20%"><img src="{{ public_path('argon/img/brand/csc_blue.png') }}" height="60px"></th>
                <th colspan="2"></th>
            </tr>
            <tr>
                <td width="1%"></td>
                <td valign="middle"><h1>CLAIM APPLICATION FORM</h1></td>
            </tr>
            <tr>
                <td colspan="2"></td>
            </tr>
        </table>
        <br>
        <table border="0" width="100%">
            <tr>
                <td width="20%">Date</td>
                <td width="5%">:</td>
                <td colspan="5">{{ $content['claim']->date->format('d F Y') }}</td>
            </tr>
            <tr>
                <td width="20%">Ref. No</td>
                <td width="5%">:</td>
                <td colspan="5">{{ $content['claim']->ref_no }}</td>
            </tr>
            <tr>
                <td colspan="7"><br></td>
            </tr>
            <tr>
                <td width="20%">Name</td>
                <td width="3%">:</td>
                <td width="25%">{{ $content['user']->name }}</td>
                <td width="4%">&nbsp;</td>
                <td width="20%">IC No</td>
                <td width="3%">:</td>
                <td width="25%">{{ $content['user']->icno }}</td>
            </tr>
            <tr>
                <td width="20%">Designation</td>
                <td width="3%">:</td>
                <td width="25%">{{ $content['user']->designation }}</td>
                <td width="4%">&nbsp;</td>
                <td width="20%">Status</td>
                <td width="3%">:</td>
                <td width="25%">
                    @if($content['claim']->status == '0')
                        Pending
                    @elseif($content['claim']->status == '1' && $content['claim']->approved == '1')
                        Approved
                    @elseif($content['claim']->status == '1' && $content['claim']->approved == '0')
                        Rejected
                    @endif
                </td>
            </tr>
            <tr>
                <td colspan="7"><br></td>
            </tr>
        </table>
        <br><br>
        <p><strong>CLAIM PAYMENT</strong></p>
        <div class="tab">
            <table width="100%" border="0">
                <tr>
                    <td width="15%">TYPE</td>
                    <td width="3%">:</td>
                    <td><u><b>{{ strtoupper($content['claim']->type) }}</b></u></td>
                </tr>
                <tr>
                    <td width="15%">AMOUNT</td>
                    <td width="3%">:</td>
                    <td><u><b>RM {{ number_format($content['claim']->amt,2) }}</b></u></td>
                </tr>
            </table>
       

        </div>
        

        <p><strong>ATTACHMENT</strong></p>
        <img src="{{ public_path('storage/Receipt/') }}{{ $content['claim']->attachment }}" width="50%">
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
