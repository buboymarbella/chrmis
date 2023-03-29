<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="PIPS">
    <meta name="keyword" content="records of Interest Profiling System">
    <meta name="author" content="archie">
    <title>CHRMIS</title>
    <style>
        @page {
            margin: 0;
        }

        body {
            margin: 5px 5px 5px 5px;
        }

        .main-div {
            margin: 0 0;
            width: 100%;
            padding: 0 0;
        }

        .main-table {
            margin: auto;
            border: 1px solid black;
        }

        .main-table2 {
            margin: auto;
            width: 600px;
        }

        .td1 {
            color: black;
            font-size: 22pt;
            font-weight: bold;
            font-style: normal;
            text-decoration: none;
            font-family: Arial Black, sans-serif;
            mso-font-charset: 0;
            mso-number-format: General;
            text-align: center;
            padding-top: 17px
        }

        .td3 {
            color: black;
            font-size: 7.0pt;
            font-weight: 700;
            font-style: italic;
            text-decoration: none;
            font-family: Arial, sans-serif;
            mso-font-charset: 0;
            mso-number-format: General;
            text-align: left;
            padding-top: 10px;
        }

        .td4 {
            color: black;
            font-size: 7.0pt;
            font-weight: 700;
            font-style: italic;
            text-decoration: none;
            font-family: Arial, sans-serif;
            mso-font-charset: 0;
            mso-number-format: General;
            text-align: left;
            padding-top: 10px;
        }

        .td5 {
            color: black;
            font-size: 7.0pt;
            font-weight: 400;
            font-style: normal;
            text-decoration: none;
            text-align: left;
            padding-left: 0;
        }

        .td6 {
            color: windowtext;
            font-size: 7.0pt;
            font-weight: 400;
            font-style: normal;
            text-decoration: none;
            font-family: Arial, sans-serif;
            mso-font-charset: 0;
            mso-number-format: General;
        }

        .td7 {
            color: white;
            font-size: 9pt;
            font-weight: 700;
            font-style: italic;
            text-decoration: none;
            font-family: "Arial Narrow", sans-serif;
            mso-font-charset: 0;
            mso-number-format: General;
            text-align: left;
            vertical-align: top;
            border-left: 1px solid black;
            border-right: 1px solid black;
            background: #969696;
        }

        .name {
            padding: 0 0;
            color: black;
            font-size: 7.5pt;
            font-weight: 400;
            font-style: normal;
            text-decoration: none;
            font-family: "Arial Narrow", sans-serif;
            mso-font-charset: 0;
            mso-number-format: "\@";
            text-align: left;
            border-top: none;
            border-right: none;
            border-left: none;
            /* vertical-align: middle;*/
            background: #EAEAEA;
            mso-pattern: black none;
            white-space: nowrap;
        }

        .name2 {
            padding: 0px;
            mso-ignore: padding;
            color: black;
            font-size: 9px;
            font-weight: 400;
            font-style: normal;
            text-decoration: none;
            font-family: "Arial Narrow", sans-serif;
            mso-font-charset: 0;
            mso-number-format: "\@";
            text-align: center;
            vertical-align: middle;
            border-top: none;
            border-right: none;
            border-left: none;
            background: #EAEAEA;
            mso-pattern: black none;
            white-space: nowrap;
        }

        .name3 {
            padding: 0px;
            mso-ignore: padding;
            color: black;
            font-size: 7.0pt;
            font-weight: 400;
            font-style: normal;
            text-decoration: none;
            font-family: "Arial Narrow", sans-serif;
            mso-font-charset: 0;
            mso-number-format: "\@";
            text-align: center;
            vertical-align: middle;
            border-top: none;
            border-right: none;
            border-left: none;
            background: #EAEAEA;
            mso-pattern: black none;
            white-space: nowrap;
        }

        .last {
            padding: 0px;
            mso-ignore: padding;
            color: black;
            font-size: 10px;
            font-weight: normal;
            font-style: normal;
            text-decoration: none;
            font-family: "Arial Narrow", sans-serif;
            mso-font-charset: 0;
            mso-number-format: "\@";
            text-align: center;
            vertical-align: middle;
            border-top: .5pt solid windowtext;
            background: #EAEAEA;
            mso-pattern: black none;
            white-space: normal;
        }

        .name4 {
            padding: 0px;
            color: black;
            font-size: 10px;
            font-weight: 400;
            font-style: normal;
            text-decoration: none;
            font-family: "Arial Narrow", sans-serif;
            mso-font-charset: 0;
            mso-number-format: 00000;
            text-align: justify;
            vertical-align: top;
            border-top: 0px;
            border-left: none;
            background: #EAEAEA;
            mso-pattern: black none;
            white-space: normal;
        }

        .sworn {
            padding: 0px 0px 0px 0px;
            mso-ignore: padding;
            color: black;
            font-size: 9px;
            font-weight: 400;
            font-style: normal;
            text-decoration: none;
            font-family: "Arial Narrow", sans-serif;
            mso-font-charset: 0;
            mso-number-format: General;
            text-align: left;
            vertical-align: middle;
            mso-background-source: auto;
            mso-pattern: auto;
            white-space: nowrap;
            text-align: center;
        }

        .name5 {
            padding: 0px;
            color: black;
            font-size: 9px;
            font-weight: 400;
            font-style: normal;
            text-decoration: none;
            font-family: "Arial Narrow", sans-serif;
            mso-font-charset: 0;
            mso-number-format: "\@";
            text-align: center;
            vertical-align: middle;
            border-top: .5pt solid windowtext;
            border-right: none;
            border-bottom: .5pt solid windowtext;
            border-left: 1.0pt solid windowtext;
            background: #EAEAEA;
            mso-pattern: black none;
            white-space: normal;
        }

        .number {
            padding: 0px;
            color: black;
            font-size: 8.0pt;
            font-weight: 400;
            font-style: normal;
            text-decoration: none;
            font-family: "Arial Narrow", sans-serif;
            background: #EAEAEA;
            border-top: none;
            border-right: none;
        }

        .extent {
            padding: 0px;
            mso-ignore: padding;
            color: black;
            font-size: 7.0pt;
            font-weight: 400;
            font-style: normal;
            text-decoration: none;
            font-family: "Arial Narrow", sans-serif;
            mso-font-charset: 0;
            mso-number-format: "\@";
            text-align: left;
            vertical-align: top;
            border-top: .5pt solid windowtext;
            border-right: none;
            border-bottom: .5pt solid windowtext;
            border-left: .5pt solid windowtext;
            background: #EAEAEA;
            mso-pattern: black none;
            mso-protection: unlocked visible;
            white-space: nowrap;
        }

        .answer {

            color: black;
            font-size: 9px;
            font-weight: 400;
            font-style: normal;
            text-decoration: none;
            font-family: Arial Narrow, sans-serif;
            text-align: center;
            vertical-align: middle;
            border: 0;
            background: white;
            mso-pattern: black none;
            mso-protection: unlocked visible;
            overflow-wrap: break-word;
            word-wrap: break-word;
        }

        .answer0 {
            padding: 0px;
            mso-ignore: padding;
            color: black;
            font-size: 10px;
            font-weight: 400;
            font-style: normal;
            text-decoration: none;
            font-family: "Arial Narrow", sans-serif;
            mso-font-charset: 0;
            mso-number-format: "\@";
            text-align: left;
            vertical-align: center;
            background: #EAEAEA;
            mso-pattern: black none;
            white-space: normal;
            border-right: 1px solid black;
        }

        .td9 {
            padding: 0px;
            mso-ignore: padding;
            color: black;
            font-size: 9px;
            font-weight: 400;
            font-style: normal;
            text-decoration: none;
            font-family: "Arial Narrow", sans-serif;
            mso-font-charset: 0;
            mso-number-format: "\@";
            text-align: left;
            vertical-align: middle;
            border-right: none;
            border-left: none;
            background: #EAEAEA;
            mso-pattern: black none;
            white-space: nowrap;
        }

        .td10 {
            color: red;
            font-size: 8.0pt;
            font-weight: 400;
            font-style: normal;
            text-decoration: none;
            font-family: "Arial Narrow", sans-serif;
        }

        .govid {
            padding: 0px;
            mso-ignore: padding;
            color: black;
            font-size: 7px;
            font-weight: normal;
            font-style: normal;
            text-decoration: none;
            font-family: "Arial Narrow", sans-serif;
            mso-font-charset: 0;
            mso-number-format: "\@";
            text-align: left;
            vertical-align: middle;
            border-top: 0px;
            background: #EAEAEA;
            mso-pattern: black none;
            white-space: normal;
        }

        .gov2 {
            padding: 0px;
            color: black;
            font-size: 9px;
            font-weight: normal;
            font-style: normal;
            text-decoration: none;
            font-family: "Arial Narrow", sans-serif;

            text-align: left;
            vertical-align: middle;
            border: 0px;
            background: #EAEAEA;
            white-space: normal;
        }


        .icountry {
            color: windowtext;
            font-size: 10.0pt;
            font-weight: 400;
            font-style: normal;
            text-decoration: none;
            font-family: "Arial Narrow", sans-serif;
            text-align: left;
            vertical-align: middle;
            border: 0px;
            white-space: nowrap;
            text-align: center;
        }

        .address {

            padding: 0px;
            mso-ignore: padding;
            color: black;
            font-size: 7pt;
            font-weight: 400;
            font-style: normal;
            text-decoration: none;
            font-family: "Arial Narrow", sans-serif;
            text-align: center;
            border: 0px;
            overflow-wrap: break-word;
            word-wrap: break-word;
        }

        .pula {
            padding: 0px;
            mso-ignore: padding;
            color: red;
            font-size: 7pt;
            font-weight: 700;
            font-style: italic;
            text-decoration: none;
            font-family: "Arial Narrow", sans-serif;
            mso-font-charset: 0;
            mso-number-format: "\@";
            text-align: center;
            vertical-align: middle;
            border: 0px;
            background: #EAEAEA;
            white-space: normal;
        }

        .address2 {
            padding: 0px;

            color: windowtext;
            font-size: 7.0pt;
            font-weight: 400;
            font-style: italic;
            text-decoration: none;
            font-family: "Arial Narrow", sans-serif;
            text-align: center;
            vertical-align: middle;
            border: 0;
            background: white;
            white-space: nowrap;
            padding: 2px 0px 2px 0px;
        }

        .sign {

            padding: 5px 0 5px 0;
            color: windowtext;
            font-size: 7pt;
            font-weight: 700;
            font-style: italic;
            text-decoration: none;
            font-family: "Arial Narrow", sans-serif;
            text-align: center;
            vertical-align: middle;
            border-top: 0px;
            background: #EAEAEA;
            mso-pattern: black none;
            white-space: normal;
        }

        .sign2 {
            padding-top: 1px;
            padding-right: 1px;
            padding-left: 1px;
            mso-ignore: padding;
            color: white;
            font-size: 8px;
            font-weight: 700;
            font-style: italic;
            text-decoration: none;
            font-family: "Arial Narrow", sans-serif;
            text-align: left;
            vertical-align: middle;
            border-top: 0px;
            background: #969696;
            white-space: normal;
        }

        .td10 {
            color: red;
            font-size: 8px;
            font-weight: 400;
            font-style: normal;
            text-decoration: none;
            font-family: "Arial Narrow", sans-serif;
        }

        .govid {
            padding: 0px;
            mso-ignore: padding;
            color: black;
            font-size: 9px;
            font-weight: 400;
            font-style: normal;
            text-decoration: none;
            font-family: "Arial Narrow", sans-serif;
            mso-font-charset: 0;
            mso-number-format: "\@";
            text-align: left;
            vertical-align: middle;
            border-top: 0px;
            background: #EAEAEA;
            mso-pattern: black none;
            white-space: normal;
        }

        .govid1 {
            color: black;
            font-size: 9px;
            font-weight: 400;
            font-style: normal;
            text-decoration: none;
            font-family: "Arial Narrow", sans-serif;
        }

        .yes {
            padding: 0px;
            mso-ignore: padding;
            color: black;
            font-size: 10px;
            font-weight: 400;
            font-style: normal;
            text-decoration: none;
            font-family: "Arial Narrow", sans-serif;
            mso-font-charset: 0;
            mso-number-format: General;
            text-align: left;
            vertical-align: top;
            border-top: none;
            border-right: none;
            border-bottom: none;
            border-left: .5pt solid windowtext;
            mso-background-source: auto;
            mso-pattern: auto;
            white-space: normal;
        }

        .answer2 {
            padding: 0px;
            color: black;
            font-size: 9px;
            font-weight: normal;
            font-style: normal;
            text-decoration: none;
            font-family: "Arial Narrow", sans-serif;
            mso-font-charset: 0;
            mso-number-format: "\@";
            text-align: left;
            vertical-align: middle;
            border: 0px;
            mso-background-source: auto;
            mso-pattern: auto;
            white-space: nowrap;
        }

        .answer3 {
            padding: 0px;
            color: black;
            font-size: 10px;
            font-weight: 400;
            font-style: normal;
            text-decoration: none;
            font-family: "Arial Narrow", sans-serif;
            text-align: center;
            vertical-align: middle;
            border-top: none;
            border-right: none;
            border-bottom: .5pt solid windowtext;
            border-left: 1.0pt solid windowtext;
            white-space: nowrap;
        }

    </style>
</head>

<body>
    <div class="main-div">
        <table width="600" class="main-table" style="border-collapse:collapse;">

            <tr>
                <td colspan="2" class="td8" width="600" style="border-bottom:1px solid black;">
                    <table width="100%" style="margin:0 0; padding:0px 0px;border-collapse:collapse;">

                        <tr>
                            <td class="number" class="number" valign="top" width="20" style="text-align:center;">34.</td>
                            <td width="350" class="answer0">Are you related by consanguinity or affinity to the appointing or recommending authority, or to
                                the chief of bureau or office or to the person who has immediate supervision over you in the Office,
                                Bureau or Department where you will be apppointed,</td>
                            <td width=""></td>
                        </tr>
                        <tr>
                            <td class="number" class="number" valign="middle" width="20" style="text-align:center;"></td>
                            <td width="" class="answer0">a. within the third degree?</td>
                            <td width="" style="padding-left:40px;font-size: 10px;">
                                <table style="border-collapse:collapse;padding:0;margin:0;width:150px;">
                                    <tr>
                                        <?php if($answer->a34 == "Yes"){ ?>
                                        <td><input type="checkbox" disabled checked name="vehicle1" value="Bike" /></td>
                                        <td style="padding-left:20px;">Yes</td>
                                        <td><input type="checkbox" disabled name="vehicle2" value="Car" /></td>
                                        <td style="padding-left:20px;">No</td>
                                        <?php }else{?>
                                        <td><input type="checkbox" disabled name="vehicle1" value="Bike" style="display: inline;" /></td>
                                        <td style="padding-left:20px;">Yes</td>
                                        <td><input type="checkbox" disabled checked name="vehicle2" value="Car" /></td>
                                        <td style="padding-left:20px;">No</td>
                                        <?php }?>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td class="number" class="number" valign="middle" width="20" style="text-align:center;"></td>
                            <td width="" class="answer0">b. within the fourth degree (for Local Government Unit - Career Employees)?</td>
                            <td width="" style="padding-left:40px;font-size: 10px;">
                                <table style="border-collapse:collapse;padding:0;margin:0;width:150px;">
                                    <tr>
                                        <?php if($answer->b34 == "Yes"){ ?>
                                        <td><input type="checkbox" disabled checked name="vehicle1" value="Bike" /></td>
                                        <td style="padding-left:20px;">Yes</td>
                                        <td><input type="checkbox" disabled name="vehicle2" value="Car" /></td>
                                        <td style="padding-left:20px;">No</td>
                                        <?php }else{?>
                                        <td><input type="checkbox" disabled name="vehicle1" value="Bike" style="display: inline;" /></td>
                                        <td style="padding-left:20px;">Yes</td>
                                        <td><input type="checkbox" disabled checked name="vehicle2" value="Car" /></td>
                                        <td style="padding-left:20px;">No</td>
                                        <?php }?>
                                    </tr>
                                </table>
                            </td>
                        </tr>

                        <tr>
                            <td class="number" class="number" valign="middle" width="20" style="text-align:center;"></td>
                            <td width="" style="border-bottom:1px solid black" class="answer0"></td>
                            <td class="yes" style="padding-left:35px;border-bottom:1px solid black" width="" style="padding-left:35px;">
                                If YES, give details: <br />
                                <?php if($answer->ab34_yes == null){  echo "N/A";}else{ echo $answer->ab34_yes;}?>
                            </td>
                        </tr>

                        <tr>
                            <td class="number" valign="center" width="20" style="text-align:center;border-top:1px solid black;">35.</td>
                            <td width="" class="answer0">a. Have you ever been found guilty of any administrative offense?</td>
                            <td width="" style="padding-left:40px;font-size: 10px;">
                                <table style="border-collapse:collapse;padding:0;margin:0;width:150px;">
                                    <tr>
                                        <?php if($answer->a35 == "Yes"){ ?>
                                        <td><input type="checkbox" disabled checked name="vehicle1" value="Bike" /></td>
                                        <td style="padding-left:20px;">Yes</td>
                                        <td><input type="checkbox" disabled name="vehicle2" value="Car" /></td>
                                        <td style="padding-left:20px;">No</td>
                                        <?php }else{?>
                                        <td><input type="checkbox" disabled name="vehicle1" value="Bike" style="display: inline;" /></td>
                                        <td style="padding-left:20px;">Yes</td>
                                        <td><input type="checkbox" disabled checked name="vehicle2" value="Car" /></td>
                                        <td style="padding-left:20px;">No</td>
                                        <?php }?>
                                    </tr>
                                </table>
                            </td>
                        </tr>

                        <tr>
                            <td class="number" valign="middle" width="20" style="text-align:center;"></td>
                            <td width="" style="" class="answer0"></td>
                            <td class="yes" width="" style="padding-left:35px;border-bottom:1px solid black;">
                                If YES, give details: <br />
                                <?php if($answer->a35_yes == null){  echo "N/A";}else{ echo $answer->a35_yes;}?>
                            </td>
                        </tr>

                        <tr>
                            <td class="number" valign="center" width="20" style=""></td>
                            <td width="" class="answer0">b. Have you been criminally charged before any court?</td>
                            <td width="" style="padding-left:40px;font-size: 10px;">
                                <table style="border-collapse:collapse;padding:0;margin:0;width:150px;">
                                    <tr>
                                        <?php if($answer->b35 == "Yes"){ ?>
                                        <td><input type="checkbox" disabled checked name="vehicle1" value="Bike" /></td>
                                        <td style="padding-left:20px;">Yes</td>
                                        <td><input type="checkbox" disabled name="vehicle2" value="Car" /></td>
                                        <td style="padding-left:20px;">No</td>
                                        <?php }else{?>
                                        <td><input type="checkbox" disabled name="vehicle1" value="Bike" style="display: inline;" /></td>
                                        <td style="padding-left:20px;">Yes</td>
                                        <td><input type="checkbox" disabled checked name="vehicle2" value="Car" /></td>
                                        <td style="padding-left:20px;">No</td>
                                        <?php }?>
                                    </tr>
                                </table>
                            </td>
                        </tr>

                        <tr>
                            <td class="number" class="number" valign="middle" width="20" style="text-align:center;"></td>
                            <td width="" style="border-bottom:1px solid black" class="answer0"></td>
                            <td class="yes" width="" style="padding-left:35px;border-bottom:1px solid black;"> If YES, give details: <br />
                                <table style="border-collapse:collapse;width:230px;padding-bottom:5px;">
                                    <tr>
                                        <td style="width:60px;text-align:right;padding-right:30px;">Date Filed:</td>

                                        <td style="border-bottom:1px solid black;text-align:center">
                                            <?php if($answer->b35_date == null){  echo "N/A";}else{ echo $answer->b35_date;}?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="text-align:right;">Status of Case/s:</td>
                                        <td style="border-bottom:1px solid black;padding-left:2px;text-align:center">
                                            <?php if($answer->b35_status == null){  echo "N/A";}else{ echo $answer->b35_status;}?>
                                        </td>
                                    </tr>

                                </table>
                            </td>
                        </tr>

                        <tr>
                            <td class="number" valign="top" width="20" style="text-align:center;border-top:1px solid black;">36.</td>
                            <td width="" valign="top" class="answer0">Have you ever been convicted of any crime or violation of any law, decree, ordinance or regulation by any court or tribunal?</td>
                            <td width="" style="padding-left:40px;font-size: 10px;">
                                <table style="border-collapse:collapse;padding:0;margin:0;width:150px;">
                                    <tr>
                                        <?php if($answer->a36 == "Yes"){ ?>
                                        <td><input type="checkbox" disabled checked name="vehicle1" value="Bike" /></td>
                                        <td style="padding-left:20px;">Yes</td>
                                        <td><input type="checkbox" disabled name="vehicle2" value="Car" /></td>
                                        <td style="padding-left:20px;">No</td>
                                        <?php }else{?>
                                        <td><input type="checkbox" disabled name="vehicle1" value="Bike" style="display: inline;" /></td>
                                        <td style="padding-left:20px;">Yes</td>
                                        <td><input type="checkbox" disabled checked name="vehicle2" value="Car" /></td>
                                        <td style="padding-left:20px;">No</td>
                                        <?php }?>
                                    </tr>
                                </table>
                            </td>
                        </tr>

                        <tr>
                            <td class="number" valign="middle" width="20" style="text-align:center;"></td>
                            <td width="" style="" class="answer0"></td>
                            <td class="yes" width="" style="padding-left:35px;padding-top:5px;border-bottom:1px solid black;">
                                If YES, give details: <br /><?php if($answer->a36_yes == null){  echo "N/A";}else{ echo $answer->a36_yes;}?>
                            </td>
                        </tr>

                        <tr>
                            <td class="number" valign="top" width="20" style="text-align:center;border-top:1px solid black;">37.</td>
                            <td width="" style="border-top:1px solid black;" valign="top" class="answer0">Have you ever been separated from the service in any of the following modes: resignation, retirement, dropped from the rolls, dismissal, termination, end of
                                term, finished contract or phased out (abolition) in the public or private sector?</td>
                            <td width="" style="padding-left:40px;font-size: 10px;">
                                <table style="border-collapse:collapse;padding:0;margin:0;width:150px;">
                                    <tr>
                                        <?php if($answer->a37 == "Yes"){ ?>
                                        <td><input type="checkbox" disabled checked name="vehicle1" value="Bike" /></td>
                                        <td style="padding-left:20px;">Yes</td>
                                        <td><input type="checkbox" disabled name="vehicle2" value="Car" /></td>
                                        <td style="padding-left:20px;">No</td>
                                        <?php }else{?>
                                        <td><input type="checkbox" disabled name="vehicle1" value="Bike" style="display: inline;" /></td>
                                        <td style="padding-left:20px;">Yes</td>
                                        <td><input type="checkbox" disabled checked name="vehicle2" value="Car" /></td>
                                        <td style="padding-left:20px;">No</td>
                                        <?php }?>
                                    </tr>
                                </table>
                            </td>
                        </tr>

                        <tr>
                            <td class="number" valign="middle" width="20" style="text-align:center;"></td>
                            <td width="" style="" class="answer0"></td>
                            <td class="yes" width="" style="padding-left:35px;padding-top:5px;border-bottom:1px solid black;">
                                If YES, give details: <br />
                                <?php if($answer->a37_yes == null){  echo "N/A";}else{ echo $answer->a37_yes;}?>
                            </td>
                        </tr>

                        <tr>
                            <td class="number" valign="top" width="20" style="text-align:center;border-top:1px solid black;">38.</td>
                            <td width="" style="border-top:1px solid black;" valign="top" class="answer0">a. Have you ever been a candidate in a national or local election held within the last year (except Barangay election)?</td>
                            <td width="" style="padding-left:40px;font-size: 10px;">

                                <table style="border-collapse:collapse;padding:0;margin:0;width:150px;">
                                    <tr>
                                        <?php if($answer->a38 == "Yes"){ ?>
                                        <td><input type="checkbox" disabled checked name="vehicle1" value="Bike" /></td>
                                        <td style="padding-left:20px;">Yes</td>
                                        <td><input type="checkbox" disabled name="vehicle2" value="Car" /></td>
                                        <td style="padding-left:20px;">No</td>
                                        <?php }else{?>
                                        <td><input type="checkbox" disabled name="vehicle1" value="Bike" style="display: inline;" /></td>
                                        <td style="padding-left:20px;">Yes</td>
                                        <td><input type="checkbox" disabled checked name="vehicle2" value="Car" /></td>
                                        <td style="padding-left:20px;">No</td>
                                        <?php }?>
                                    </tr>
                                </table>
                            </td>
                        </tr>

                        <tr>
                            <td class="number" valign="middle" width="20" style="text-align:center;"></td>
                            <td width="" style="" class="answer0"></td>
                            <td class="yes" width="" style="padding-left:35px;padding-top:5px;">
                                If YES, give details: <br /><?php if($answer->a38_yes == null){  echo "N/A";}else{ echo $answer->a38_yes;}?>
                            </td>
                        </tr>

                        <tr>
                            <td class="number" valign="top" width="20" style="text-align:center;"></td>
                            <td width="" style="" valign="top" class="answer0">b. Have you ever been a candidate in a national or local election held within the last year (except Barangay election)?</td>
                            <td width="" style="padding-left:40px;font-size: 10px;">
                                <table style="border-collapse:collapse;padding:0;margin:0;width:150px;">
                                    <tr>
                                        <?php if($answer->b38 == "Yes"){ ?>
                                        <td><input type="checkbox" disabled checked name="vehicle1" value="Bike" /></td>
                                        <td style="padding-left:20px;">Yes</td>
                                        <td><input type="checkbox" disabled name="vehicle2" value="Car" /></td>
                                        <td style="padding-left:20px;">No</td>
                                        <?php }else{?>
                                        <td><input type="checkbox" disabled name="vehicle1" value="Bike" style="display: inline;" /></td>
                                        <td style="padding-left:20px;">Yes</td>
                                        <td><input type="checkbox" disabled checked name="vehicle2" value="Car" /></td>
                                        <td style="padding-left:20px;">No</td>
                                        <?php }?>
                                    </tr>
                                </table>
                            </td>
                        </tr>

                        <tr>
                            <td class="number" valign="middle" width="20" style="text-align:center;"></td>
                            <td width="" style="" class="answer0"></td>
                            <td class="yes" width="" style="padding-left:35px;padding-top:5px;border-bottom:1px solid black;">
                                If YES, give details: <br /><?php if($answer->b38_yes == null){  echo "N/A";}else{ echo $answer->b38_yes;}?>
                            </td>
                        </tr>

                        <tr>
                            <td class="number" valign="top" width="20" style="text-align:center;border-top:1px solid black;">39.</td>
                            <td width="" style="border-top:1px solid black;" valign="top" class="answer0">Have you acquired the status of an immigrant or permanent resident of another country?</td>
                            <td width="" style="padding-left:40px;font-size: 10px;">
                                <table style="border-collapse:collapse;padding:0;margin:0;width:150px;">
                                    <tr>
                                        <?php if($answer->a39 == "Yes"){ ?>
                                        <td><input type="checkbox" disabled checked name="vehicle1" value="Bike" /></td>
                                        <td style="padding-left:20px;">Yes</td>
                                        <td><input type="checkbox" disabled name="vehicle2" value="Car" /></td>
                                        <td style="padding-left:20px;">No</td>
                                        <?php }else{?>
                                        <td><input type="checkbox" disabled name="vehicle1" value="Bike" style="display: inline;" /></td>
                                        <td style="padding-left:20px;">Yes</td>
                                        <td><input type="checkbox" disabled checked name="vehicle2" value="Car" /></td>
                                        <td style="padding-left:20px;">No</td>
                                        <?php }?>
                                    </tr>
                                </table>
                            </td>
                        </tr>

                        <tr>
                            <td class="number" valign="middle" width="20" style="text-align:center;"></td>
                            <td width="" style="" class="answer0"></td>
                            <td class="yes" width="" style="padding-left:35px;padding-top:5px;border-bottom:1px solid black;">
                                If YES, give details (country): <br />
                                <?php if($answer->a39_yes == null){  echo "N/A";}else{ echo $answer->a39_yes;}?>
                            </td>
                        </tr>
                        <!-- 39 -->
                        <tr>
                            <td class="number" valign="top" width="20" style="text-align:center;border-top:1px solid black;">40.</td>
                            <td width="" style="border-top:1px solid black;" valign="top" class="answer0">Pursuant to: (a) Indigenous People's Act (RA 8371); (b) Magna Carta for Disabled Persons
                                (RA 7277); and (c) Solo Parents Welfare Act of 2000 (RA 8972), please answer the following items:</td>
                            <td width="" style="">
                            </td>
                        </tr>




                        <tr>
                            <td class="number" valign="top" width="20" style="text-align:center;">a</td>
                            <td width="" style="" valign="top" class="answer0">Are you a member of any indigenous group?</td>
                            <td width="" style="padding-left:40px;font-size: 10px;">
                                <table style="border-collapse:collapse;padding:0;margin:0;width:150px;">
                                    <tr>
                                        <?php if($answer->a40 == "Yes"){ ?>
                                        <td><input type="checkbox" disabled checked name="vehicle1" value="Bike" /></td>
                                        <td style="padding-left:20px;">Yes</td>
                                        <td><input type="checkbox" disabled name="vehicle2" value="Car" /></td>
                                        <td style="padding-left:20px;">No</td>
                                        <?php }else{?>
                                        <td><input type="checkbox" disabled name="vehicle1" value="Bike" style="display: inline;" /></td>
                                        <td style="padding-left:20px;">Yes</td>
                                        <td><input type="checkbox" disabled checked name="vehicle2" value="Car" /></td>
                                        <td style="padding-left:20px;">No</td>
                                        <?php }?>
                                    </tr>
                                </table>
                            </td>
                        </tr>

                        <tr>
                            <td class="number" valign="middle" width="20" style="text-align:center;"></td>
                            <td width="" style="" class="answer0"></td>
                            <td class="yes" width="" style="padding-left:35px;padding-top:5px;">
                                If YES, give details: <br />
                                <?php if($answer->a40_yes == null){  echo "N/A";}else{ echo $answer->a40_yes;}?>
                            </td>
                        </tr>

                        <tr>
                            <td class="number" valign="top" width="20" style="text-align:center;">b</td>
                            <td width="" style="" valign="top" class="answer0">Are you a person with disability?</td>
                            <td width="" style="padding-left:40px;font-size: 10px;">
                                <table style="border-collapse:collapse;padding:0;margin:0;width:150px;">
                                    <tr>
                                        <?php if($answer->b40 == "Yes"){ ?>
                                        <td><input type="checkbox" disabled checked name="vehicle1" value="Bike" /></td>
                                        <td style="padding-left:20px;">Yes</td>
                                        <td><input type="checkbox" disabled name="vehicle2" value="Car" /></td>
                                        <td style="padding-left:20px;">No</td>
                                        <?php }else{?>
                                        <td><input type="checkbox" disabled name="vehicle1" value="Bike" style="display: inline;" /></td>
                                        <td style="padding-left:20px;">Yes</td>
                                        <td><input type="checkbox" disabled checked name="vehicle2" value="Car" /></td>
                                        <td style="padding-left:20px;">No</td>
                                        <?php }?>
                                    </tr>
                                </table>
                            </td>
                        </tr>

                        <tr>
                            <td class="number" valign="middle" width="20" style="text-align:center;"></td>
                            <td width="" style="" class="answer0"></td>
                            <td class="yes" width="" style="padding-left:35px;padding-top:5px;">
                                If YES, please specify ID No: <br />
                                <?php if($answer->b40_yes == null){  echo "N/A";}else{ echo $answer->b40_yes;}?>
                            </td>
                        </tr>

                        <tr>
                            <td class="number" valign="top" width="20" style="text-align:center;">c</td>
                            <td width="" style="" valign="top" class="answer0">Are you a solo parent?</td>
                            <td width="" style="padding-left:40px;font-size: 10px;">
                                <table style="border-collapse:collapse;padding:0;margin:0;width:150px;">
                                    <tr>
                                        <?php if($answer->c40 == "Yes"){ ?>
                                        <td><input type="checkbox" disabled checked name="vehicle1" value="Bike" /></td>
                                        <td style="padding-left:20px;">Yes</td>
                                        <td><input type="checkbox" disabled name="vehicle2" value="Car" /></td>
                                        <td style="padding-left:20px;">No</td>
                                        <?php }else{?>
                                        <td><input type="checkbox" disabled name="vehicle1" value="Bike" style="display: inline;" /></td>
                                        <td style="padding-left:20px;">Yes</td>
                                        <td><input type="checkbox" disabled checked name="vehicle2" value="Car" /></td>
                                        <td style="padding-left:20px;">No</td>
                                        <?php }?>
                                    </tr>
                                </table>
                            </td>
                        </tr>

                        <tr>
                            <td class="number" valign="middle" width="20" style="text-align:center;"></td>
                            <td width="" style="" class="answer0"></td>
                            <td class="yes" width="" style="padding-left:35px;padding-top:5px;">
                                If YES, please specify ID No: <br />
                                <?php if($answer->c40_yes == null){  echo "N/A";}else{ echo $answer->c40_yes;}?>
                            </td>
                        </tr>


                    </table>
                </td>
            </tr>


            <tr>
                <td colspan="2" class="td8" width="580px" style="border:1px solid black;">

                    <table style="margin:0 0; padding:0px 0px;border-collapse:collapse;">

                        <tr>
                            <td valign="top" style="width:580px;">
                                <table style="margin:0 0; padding:0px 0px;border-collapse:collapse;width:580px;">
                                    <tr>
                                        <td class="number" valign="middle" height="20" width="20" style="text-align:center;border-bottom:1px solid black;">41.</td>
                                        <td colspan="3" class="td9" style="text-align:left;border-bottom:1px solid black;border-right:1px solid black;" colspan="4">
                                            REFERENCES <span class="td10"> (Person not related by consanguinity or affinity to applicant /appointee)</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="number" valign="middle" height="20" width="20" style="text-align:center;border-bottom:1px solid black;"></td>
                                        <td height="20" style="border-bottom:1px solid black;" width="180" class="name2">NAME</td>
                                        <td height="20" style="border-left:1px solid black;border-bottom:1px solid black;border-right:1px solid black;" width="130" class="name2">ADDRESS</td>
                                        <td height="20" style="border-left:1px solid black;border-bottom:1px solid black;border-right:1px solid black;" class="name2">TEL. NO.</td>
                                    </tr>
                                    @forelse($reference as $key=>$reference)
	                                <tr>
                                        <td class="answer" valign="middle" height="20" width="20" style="text-align:center;border-bottom:1px solid black;"></td>
                                        <td colspan="" height="20" style="border-bottom:1px solid black;" class="answer">
                                            {{ $reference->name == null ? 'N/A' : $reference->name }}</td>
                                        <td height="20" style="border-left:1px solid black;border-bottom:1px solid black;border-right:1px solid black;" class="answer">
                                            {{ $reference->address == null ? 'N/A' : $reference->address }}</td>
                                        <td height="20" style="border-left:1px solid black;border-bottom:1px solid black;border-right:1px solid black;" class="answer">
                                            {{ $reference->telephone_no == null ? 'N/A' : $reference->telephone_no }}</td>
                                    </tr>
                                    @empty
                                    @endforelse  
                                    <tr>
                                        <td class="answer" valign="middle" height="20" width="20" style="text-align:center;border-bottom:1px solid black;"></td>
                                        <td colspan="" height="20" style="border-bottom:1px solid black;" class="answer">N/A</td>
                                        <td height="20" style="border-left:1px solid black;border-bottom:1px solid black;border-right:1px solid black;" class="answer">N/A</td>
                                        <td height="20" style="border-left:1px solid black;border-bottom:1px solid black;border-right:1px solid black;" class="answer">N/A</td>
                                    </tr>

                                    <tr>
                                        <td class="answer" valign="middle" height="20" width="20" style="text-align:center;border-bottom:1px solid black;"></td>
                                        <td colspan="" height="20" style="border-bottom:1px solid black;" class="answer">N/A</td>
                                        <td height="20" style="border-left:1px solid black;border-bottom:1px solid black;border-right:1px solid black;" class="answer">N/A</td>
                                        <td height="20" style="border-left:1px solid black;border-bottom:1px solid black;border-right:1px solid black;" class="answer">N/A</td>

                                    </tr>

                                    <tr>
                                        <td height="20" style="text-align:center;border-bottom:1px solid black" width="20" class="number" valign="top">42</td>
                                        <td colspan="3" height="20" class="name4" style="black;text-align:justify;padding-right:10px;border-right:1px solid black;border-bottom:1px solid black">
                                            I declare under oath that I have personally accomplished this Personal Data Sheet which is a true, correct and complete statement pursuant to the provisions of pertinent laws, rules and regulations of the Republic of the Philippines. I authorize the agency head/authorized representative to verify/validate the contents stated herein. I agree that any misrepresentation made in this document and its attachments shall cause the filing of administrative/criminal case/s against me.</td>
                                    </tr>

                                </table>
                            </td>
                            <td valign="top" rowspan="2" style="margin-left: auto;margin-right: auto;">
                                <br />
                                <table style="border-collapse:collapse;text-align:center; margin-left: auto;margin-right: auto;">
                                    <tr>
                                        
                                        <td><img src="{{ base_path('/public/uploads/profile/'.$photo->image) }}" style="width:120px;height:140px;" /></td>
                                    </tr>
                                </table>
                                <br />
                                <table style="border-collapse:collapse;text-align:center;border:1px solid black;margin-left: auto;margin-right: auto;">
                                    <tr>
                                        <td style="width:120px;height:110px;">&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td class="last" style="width:169px;height:24px;border:1px solid black;">Right Thumbmark</td>
                                    </tr>

                                </table>
                            </td>

                        </tr>


                        <tr>
                            <td valign="top">
                                <table style="border-collapse:collapse;width:580px;">
                                    <tr>
                                        <td valign="top" style="" height="0" width="300px">
                                            <table style="margin-left:17px;border-collapse:collapse;border:1px solid black;">
                                                <tr>
                                                    <td class="gov2" style="border-top:1px solid black;" colspan="2">
                                                        <font class="govid1">Government Issued ID</font>
                                                        <font class="govid">(i.e.Passport, GSIS, SSS, PRC, Driver's License,</font>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="gov2">
                                                        <font class="govid1"></font>
                                                        <font class="govid">etc.)</font>
                                                    </td>
                                                    <td class="gov2">
                                                        <font class="govid1"></font>
                                                        <font class="govid">PLEASE INDICATE ID Number and Date of </font>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="gov2" colspan="2" style="border-bottom:1px solid black;">
                                                        <font class="govid1">Issuance</font>
                                                    </td>
                                                </tr>
                                                <tr>
                                                     @forelse($issue as $key=>$issue)
                                                    <td height="20" class="answer2" style="border-bottom:1px solid black;">Government Issued ID</td>
                                                    <td height="20" class="answer2" style="border-bottom:1px solid black;">
                                                        <b> {{ $issue->gov_issue == null ? 'N/A' : $issue->gov_issue }}</b>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td height="20" class="answer2" style="border-bottom:1px solid black;">D/License/Passport No.:</td>
                                                    <td height="20" class="answer2" style="border-bottom:1px solid black;">
                                                        <b> {{ $issue->license_number == null ? 'N/A' : $issue->license_number }}</b>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td height="20" class="answer2" style="border-bottom:1px solid black;">Date/Place of Issuance:</td>
                                                    <td height="20" class="answer2" style="border-bottom:1px solid black;">
                                                          <b> {{ $issue->place_issue == null ? 'N/A' : $issue->place_issue }}</b>
                                                    </td>
                                                </tr>
                                                     @empty
                                                     @endforelse  
                                            </table>
                                        </td>
                                        <td valign="top" style="text-align:left;">

                                            <table style="margin-left:10px;border-collapse:collapse;border:1px solid black;" width="278px">
                                                <tr>
                                                    <td height="75" style="text-align:center"></td>
                                                </tr>
                                                <tr>
                                                    <td class="name5">Signature (Sign inside the box)</td>
                                                </tr>
                                                <tr>
                                                    <td class="answer3">&nbsp;</td>
                                                </tr>
                                                <tr>
                                                    <td class="name5">Date Accomplished </td>
                                                </tr>

                                            </table>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>

                    </table>
                </td>

            </tr>
            <tr>
                <td colspan="2" class="td8" width="600">

                    <table style="border-collapse:collapse;margin-top:7px" width="100%;">
                        <tr>
                            <td height="39" class="sworn" width="30" valign="top">SUBSCRIBED AND SWORN to before me this _______________________________, affiant exhibiting his/her validly issued government ID as indicated above.</td>
                        </tr>
                        <tr>
                            <td style="">
                                <table style="border-collapse:collapse;text-align:center;border:1px solid black; margin-left: auto;margin-right: auto;">
                                    <tr>
                                        <td style="height:71px;">&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td class="last" style="width:260;height:20px;">Person Administering Oath</td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td height="15" class="sworn" width="306" valign="top">&nbsp;</td>
                        </tr>
                    </table>

                </td>
            </tr>


        </table>

        <table class="main-table2" style="border-collapse:collapse;width:100%;">


            <tr>
                <td width="" style="text-align:right;padding: 0px 2px 0px 0px;
				mso-ignore: padding;
				color: black;
				font-size: 7.0pt;
				font-weight: 400;
				font-style: italic;
				text-decoration: none;
				font-family: 'Arial Narrow', sans-serif;">
                    CS FORM 212
                    (Revised 2017), Page 4 of 4
                </td>
            </tr>
        </table>
    </div>
</body>

</html>
