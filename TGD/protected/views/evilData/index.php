		<div class="container">
            <div class="row block-row">

                <!-- threats identified in your browser -->
                <section id="threats-identified" class="col-lg-6 col-md-6 col-sm-16">
                    <div>
                        <h2 class="no-bottom">Identified threats</h2>

                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#last-week" data-toggle="tab">1 week</a></li>
                            <li><a href="#last-month" data-toggle="tab">1 month</a></li>
                            <li><a href="#last-year" data-toggle="tab">1 year</a></li>
                        </ul>

                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div class="tab-pane active chart clearfix" id="last-week">
                                <div class="clearfix no-bottom">
                                    <div class="item">
                                        <span class="amount adtracks">0</span>
                                        <span class="subtext">Total</span>
                                    </div>
                                    <div class="item">
                                        <span class="amount small top">Top 5%</span>
                                        <span class="subtext">of all users this week</span>
                                    </div>

                                </div>
                                <div class="legend">
                                    <ul>
                                        <li>Monday</li>
                                        <li>Sunday</li>
                                    </ul>
                                </div>
                            </div>
                            <div class="tab-pane chart clearfix" id="last-month">
                                <div class="clearfix no-bottom">
                                    <div class="item">
                                        <span class="amount adtracks">0</span>
                                        <span class="subtext">Total</span>
                                    </div>
                                    <div class="item">
                                        <span class="amount small top">Top 15%</span>
                                        <span class="subtext">of all users this month</span>
                                    </div>

                                </div>
                                <div class="legend">
                                    <ul>
                                        <li class="first_day">April 12</li>
                                        <li class="last_day">May 11</li>
                                    </ul>
                                </div>
                            </div>
                            <div class="tab-pane chart clearfix" id="last-year">
                                <div class="clearfix no-bottom">
                                    <div class="item">
                                        <span class="amount adtracks">0</span>
                                        <span class="subtext">Total</span>
                                    </div>
                                    <div class="item">
                                        <span class="amount small top">Top 20%</span>
                                        <span class="subtext">of all users his year</span>
                                    </div>

                                </div>
                                <div class="legend">
                                    <ul>
                                        <li class="first_day">June '13</li>
                                        <li class="last_day">May '14</li>
                                    </ul>
                                </div>
                            </div>
                        </div>



                    </div>                        
                </section>


                <section id="mix-threats" class="col-lg-10 col-md-10 col-sm-16">
                    <div>
                        <h2>Mix of threats</h2>
                        <div class="legend clearfix">
                            <div class="advertising"><span></span>Advertising</div>
                            <div class="social"><span></span>Social Widgets</div>
                            <div class="analytics"><span></span>Analytics</div>
                            <div class="others"><span></span>Others</div>
                        </div>
                        <div class="chart clearfix">
                            <div>You</div>
                            <div><img src="<?php echo Yii::app()->theme->baseUrl; ?>/img/logo-big.png"/></div>
                        </div>
                    </div>
                </section>
            </div>
            <div class="row block-row">
                <section id="threats-ranking" class="col-lg-6 col-md-6 col-sm-16">
                    <div>
                        <h2>Page rank by identified threats</h2>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Website</th>
                                    <th>Threats</th>
                                    <th>Visits</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($adtracks as $adtrack) {?>
                                <tr>
                                    <td><?php echo $adtrack->domain; ?></td>
                                    <td><?php echo $adtrack->adtracks; ?></td>
                                    <td><?php echo $adtrack->visited; ?></td>
                                    <td><?php echo $adtrack->total; ?></td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </section>



                <!-- your risk profile -->
                <section id="risk-profile" class="col-lg-10 col-md-10 col-sm-16">
                    <div>
                        <h2>Your risk profile</h2>
                        <div class="row">
                            <div class="col-md-4 col-lg-4"><div class="square you mid-risk">You</div></div>
                            <div class="col-md-4 col-lg-4"><span class="amount risk you">0</span><span class="subtext">Threats per page visited</span></div>
                            <div class="col-md-4 col-lg-4"><span class="amount ratio you">0</span><span class="subtext">Percentage of threats allowed</span></div>
                            <div class="col-md-4 col-lg-4 risk-meter mid-risk">Risk Lover</div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 col-lg-4"><div class="square tgd"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/img/logo-20px.png"/><br/>Average</div></div>
                            <div class="col-md-4 col-lg-4"><span class="amount risk average">0</span><span class="subtext">Threats per page visited</span></div>
                            <div class="col-md-4 col-lg-4"><span class="amount ratio average">0</span><span class="subtext">Percentage of threats allowed</span></div>
                            <div class="col-md-4 col-lg-4"></div>
                        </div>
                    </div>

                </section>
            </div>
        </div>

        <!-- Bootstrap core JavaScript
        ================================================== -->
        <!-- Placed at the end of the document so the pages load faster -->
        <script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/Chart.min.js"></script>
        <script>

            // Bar chart
            var canvasTargetWeek = $('#last-week .no-bottom');
            var canvasTargetMonth = $('#last-month .no-bottom');
            var canvasTargetYear = $('#last-year .no-bottom');

            var availableWidth = canvasTargetWeek.innerWidth();
            var paddingLeft = (parseInt(canvasTargetWeek.css("paddingLeft").replace(/px/, "")));
            var paddingRight = (parseInt(canvasTargetWeek.css("paddingRight").replace(/px/, "")));
            var paddingHorizontal = paddingLeft + paddingRight;
            var canvasSide = availableWidth - paddingHorizontal;

            canvasTargetWeek.after('<canvas id="chart-threats-week"></canvas>');
            $('#chart-threats-week').attr('width', canvasSide).attr('height', '230px');

            canvasTargetMonth.after('<canvas id="chart-threats-month"></canvas>');
            $('#chart-threats-month').attr('width', canvasSide).attr('height', '230px');

            canvasTargetYear.after('<canvas id="chart-threats-year"></canvas>');
            $('#chart-threats-year').attr('width', canvasSide).attr('height', '230px');

            // Charts data
            var optionsThreats = {
                scaleShowLabels: false,
                scaleShowGridLines: false,
                barShowStroke: false,
                scaleLineColor: "rgba(0,0,0,0)",
                scaleGridLineColor: "rgba(0,0,0,0)"

            };

            $.get( "<?php echo Yii::app()->createUrl('evilData/DataThreatsWeek')?>", function( result ) {

                var dataThreatsWeek = {
                    labels: ["", "", "", "", "", "", ""],
                    datasets: [
                        {
                            fillColor: "rgb(252, 195, 74)",
                            strokeColor: "rgba(220,220,220,1)",
                            data: result.data
                        }
                    ]
                };

                $('#last-week .amount.adtracks').html(result.total);

                $('#last-week .amount.small.top').html('Top ' + result.percentile + '%');
                
                var chartThreatsWeekCtx = $("#chart-threats-week").get(0).getContext("2d");
                var chartThreatsWeek = new Chart(chartThreatsWeekCtx).Bar(dataThreatsWeek, optionsThreats);

                

            }, "json" );


            $.get( "<?php echo Yii::app()->createUrl('evilData/DataThreatsMonth')?>", function( result ) {

                var dataThreatsMonth = {
                    labels: ["", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", ""],
                    datasets: [
                        {
                            fillColor: "rgb(252, 195, 74)",
                            strokeColor: "rgba(220,220,220,1)",
                            data: result.data
                        }
                    ]
                };

                $('#last-month .amount.adtracks').html(result.total);

                $('#last-month .first_day').html(result.first_day);
                $('#last-month .last_day').html(result.last_day);

                $('#last-month .amount.small.top').html('Top ' + result.percentile + '%');
                

                var chartThreatsMonthCtx = $("#chart-threats-month").get(0).getContext("2d");
                var chartThreatsMonth = new Chart(chartThreatsMonthCtx).Bar(dataThreatsMonth, optionsThreats);

            }, "json" );
            

            $.get( "<?php echo Yii::app()->createUrl('evilData/DataThreatsYear')?>", function( result ) {

                var dataThreatsYear = {
                    labels: ["", "", "", "", "", "", "", "", "", "", "", ""],
                    datasets: [
                        {
                            fillColor: "rgb(252, 195, 74)",
                            strokeColor: "rgba(220,220,220,1)",
                            data: result.data
                        }
                    ]
                };

                $('#last-year .amount.adtracks').html(result.total);

                $('#last-year .first_day').html(result.first_day);
                $('#last-year .last_day').html(result.last_day);

                $('#last-year .amount.small.top').html('Top ' + result.percentile + '%');
                
                var chartThreatsYearCtx = $("#chart-threats-year").get(0).getContext("2d");
                var chartThreatsYear = new Chart(chartThreatsYearCtx).Bar(dataThreatsYear, optionsThreats);

            }, "json" );
            
            $.get( "<?php echo Yii::app()->createUrl('evilData/RiskRatios')?>", function( result ) {

               $('#risk-profile .amount.risk.you').html(result.risk_you);
               $('#risk-profile .amount.risk.average').html(result.risk_average);

               $('#risk-profile .amount.ratio.you').html(result.risk_ratio_you+"%");
               $('#risk-profile .amount.ratio.average').html(result.risk_ratio_average+"%");

                
            }, "json" );

            
            


            
            

            // Donught charts

            canvasTarget = $('#mix-threats .chart');
            var gap = 40;
            availableWidth = canvasTarget.innerWidth();
            paddingLeft = (parseInt(canvasTarget.css("paddingLeft").replace(/px/, "")));
            paddingRight = (parseInt(canvasTarget.css("paddingRight").replace(/px/, "")));
            paddingHorizontal = paddingLeft + paddingRight;
            canvasSide = (availableWidth - paddingHorizontal - gap) / 2;
            canvasTarget.append('<canvas id="chart-you"></canvas>', '<canvas id="chart-tgd"></canvas>');
            $('#chart-you').attr('width', canvasSide).attr('height', canvasSide).css("marginRight", (gap / 2) + "px");
            $('#chart-tgd').attr('width', canvasSide).attr('height', canvasSide).css("marginLeft", (gap / 2) + "px");

            $.get( "<?php echo Yii::app()->createUrl('evilData/AdtracksRatios')?>", function( result ) {

                var dataYou =result.adtracks_you;
                var dataTGD = result.adtracks_average;

                //Get context with jQuery - using jQuery's .get() method.
                var chartYouCtx = $("#chart-you").get(0).getContext("2d");
                var chartTGDCtx = $("#chart-tgd").get(0).getContext("2d");
                var chartYou = new Chart(chartYouCtx).Doughnut(dataYou);
                var chartTGD = new Chart(chartTGDCtx).Doughnut(dataTGD);

                
            }, "json" );

        </script>