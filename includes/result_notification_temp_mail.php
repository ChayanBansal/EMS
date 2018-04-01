<html>
                        <head>
                        <style>
                        body
                        {
                            text-align:center;
                            
                        }
                        .text{
                            color: #000000;
                            line-height: 150%;
                            margin: 10px;
                        font-family: Georgia, Times, "Times New Roman", serif;
                        font-size: 16px;
                        text-align: left;
                        display: flex;
                        justify-content: space-between;
                        }
                        .title{
                            font-size: 20px;
                            color: #2A458E;
                            font-family: "Lucida Sans Unicode", "Lucida Grande", "Lucida Sans", Geneva, Verdana, sans-serif;
                            font-weight: 400;
                            line-height: 33px;
                            display:flex;
                            justify-content: center;
                            
                        }
                        .mcontainer{
                            padding: 10px;
                            display: flex;
                          justify-content: center;
                          border: 10px solid navy;
                        }
                        .mailcontainer{
                            font-size: 24px !important;
                            width: 610px !important;
                            min-height: 70px !important;
                            padding: 5px !important;
                            text-align: center;
                            background: white;
                            font-family: "Open Sans", sans-serif;
                            align-items: center;
                            margin-bottom:30px;
                           
                        }
                        .portal{
                            font-size: 18px;
                        line-height: 27px;
                        color: #555555;;
                        border-bottom: 1px solid black;
                        margin: 15px;
                        display: flex;
                        justify-content: space-between;
                        }
                        #hr{
                            color: #1978C8;
                            border: 2px solid #1978C8;
                            width: 100%;
                        }
                       
                        
                        .details{
                            margin: 10px;
                            padding: 10px;
                            border: 2px dashed black;
                            font-weight: bolder;
                            font-family: "Open Sans", sans-serif;
                            text-decoration: none;
                            font-size: 16px;
                            line-height: 33px;
                            width: 100%;
                            margin: 20px;
                        }
                        .note{
                            line-height: 15px;
                        font-size: 16px;
                        color: #555555;
                        font-family: Arial, "Helvetica Neue", Helvetica, sans-serif;
                        text-align: left;
                        }
                        ol li{
                            line-height: 18px;
                            margin: 10px;
                        }
                        </style>
                        </head>
                        <body>
                        <div class="mcontainer">
                        <div class="mailcontainer">
                        <div class="title">Symbiosis University Of Applied Sciences<br>Office of COE</div>
                        <hr id="hr">
                        <div class="portal">Result Notification - MAIN<span><?php
                        echo(date("F j, Y"));
                        ?></span></div>
                        <div class="text" >
                            <table>
                                <tr>
                                    <td>Enrollment </td>
                                    <td>2016AB001022</td>
                                </tr>
                                <tr>
                                    <td>Name </td>
                                    <td>Chayan Bansal</td>
                                </tr>
                                <tr>
                                    <td>Course </td>
                                    <td>BTech (CSIT)</td>
                                </tr>
                                <tr>
                                    <td>Start Year (Batch) </td>
                                    <td>2016</td>
                                </tr>
                                <tr>
                                    <td>Semester </td>
                                    <td>4</td>
                                </tr>
                                <tr>
                                    <td>SGPA </td>
                                    <td>9.69</td>
                                </tr>
                            </table>
                            <img src="..\stud_img\2016AB001010.jpg">
                           

                            </div>
                         
                            </div>
                        </div>
                        </body>
                        </html>

                        <?php
                        echo(date("Y-m-d"));
                        ?>