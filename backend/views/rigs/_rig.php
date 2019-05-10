    <div id="raw-html" data-id="<?= $modelFirst->id ?>">
        <span class="raw-corner">
            <span class="wrap-info-corner">
                <span class="info-scrollable">Scrollable</span><br/>  
                <span id="count-sec">Auto-updating (15s)</span>
                <!-- <span class="count-unit">s</span>  -->
            </span><br/>
            <span class="wrap-link-corner">
                <a class="link-raw" target="_blank"><i class="glyphicon glyphicon-align-left"></i> New tab</a>
            </span>
        </span>
        <div id="div-raw">
            <?php //echo $modelFirst->lastJournal->response_html; ?>
        </div>
    </div>

    <div id="rig-first">

        <div class="pull-left chart-container"> <canvas id="chart-first"></canvas> </div>

        <div class="pull-left info-first">
            <span class="span-hostname"><?= $modelFirst->hostname ?></span>
            <small class="span-ip"><?= $modelFirst->ip ?></small><br/><br/>


            <div class="enable-status pull-right">
                <span id="act-switch" class="enable-switch enable-<?= $modelFirst->status ? 'on' : 'off' ?>"></span>
            </div>

            <div class="enable-status pull-right"> <span id="act-config"></span> </div>
            <div class="enable-status pull-right"> <span id="act-reboot" class="enable-reboot"></span> </div>
            <div class="enable-status pull-right"> <span id="act-eres" class="enable-eres"></span> </div>

            <?php if ($modelFirst->lastJournal) : ?>

                <small class="span-runtime">
                    Runtime: <?= (int)($modelFirst->lastJournal->runtime / 60) . ' h ' . ($modelFirst->lastJournal->runtime % 60) ?> min
                </small><br/>

                <div class="div-temp pull-left" style="width: 100%">
                    <?php
                        if (sizeof($modelFirst->lastJournal->tempData)) {
                            foreach ($modelFirst->lastJournal->tempData as $key => $data) {
                                echo '<small class="span-temp ' . 
                                    ((int)$data['temp'] > 60 || !(int)$data['temp'] ? 'text-danger' : '') . '">' . 
                                    $data['temp'] . '/' . $data['fanspeed'] . '</small>' . 
                                    (($key + 1) % 4 == 0 ? '<br/>' : '');
                            }
                        }
                    ?>
                </div><br/><br/><br/><br/>

                <small class="label label-up label-<?= ($modelFirst->lastJournal->up ? 'success' : 'danger') ?>">
                    State: <?= ($modelFirst->lastJournal->up ? 'UP' : 'DOWN') ?>
                </small>

                <small class="label label-count label-<?= (count(explode(";", $modelFirst->lastJournal->rate_details)) < 8 ? 'danger' : 'success') ?>">
                    GPUs: <?= count(explode(";", $modelFirst->lastJournal->rate_details)) ?>
                </small>

                <small class="label label-rate label-<?= ($modelFirst->lastJournal->totalHashrate < 210 ? 'danger' : ($modelFirst->lastJournal->totalHashrate >= 230 ? 'success' : 'warning')) ?>">
                    Rate: <?= $modelFirst->lastJournal->totalHashrate ?> MH/s
                </small><br/>

            <?php else : ?>

                <small class="span-runtime"> Runtime: -- min </small><br/>

                <div class="div-temp pull-left" style="width: 100%">
                    <?php for ($i = 0; $i < 8; $i++) {
                            echo '<small class="span-temp text-danger">--&#176;C/--%</small>' . (($i + 1) % 4 == 0 ? '<br/>' : '');
                    } ?>
                </div><br/><br/><br/>

                <small class="label label-up label-danger"> State: DOWN </small>
                <small class="label label-count label-danger"> GPUs: -- </small>
                <small class="label label-rate label-danger"> Rate: -- MH/s </small><br/>

            <?php endif; ?>

        </div>
    </div>