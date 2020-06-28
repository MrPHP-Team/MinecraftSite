        <?php 
            $time = microtime();
            $time = explode(' ', $time);
            $time = $time[1] + $time[0];
            $finish = $time;
            $total_time = round(($finish - $start), 4);
        ?>
        <footer>
            <div class="container">
                <div class="copyright">
                    <?php echo FOOTER_COPYRIGHT_TEXT . " | " . FOOTER_COPYRIGHT_JAKSAR77 ?><br>
                    <small><?php  echo 'Page generated in '.$total_time.' seconds.'; ?></small>
                </div>
            </div>
        </footer>
        <!-- SCRIPTS -->
        <!-- JQuery -->
        <script type="text/javascript" src="core/mdbootstrap/js/jquery.js"></script>
        <!-- Bootstrap tooltips -->
        <script type="text/javascript" src="core/mdbootstrap/js/popper.js"></script>
        <!-- Bootstrap core JavaScript -->
        <script type="text/javascript" src="core/mdbootstrap/js/bootstrap.min.js"></script>
        <!-- MDB core JavaScript -->
        <script type="text/javascript" src="core/mdbootstrap/js/mdb.min.js"></script>
        <!-- Server status JavaScript -->
        <script type="text/javascript" src="core/custom-js/players-online.min.js"></script>
        <script>
            MinecraftAPI.getServerStatus('<?php echo MAIN_SERVER_HOSTNAME ?>', {
                port: <?php echo MAIN_SERVER_PORT ?>
            }, function (err, status) {
                if (err) {
                    return document.querySelector('.server-status').innerHTML = 'Error loading status';
                }
                document.querySelector('.server-online').innerHTML = status.online ? '<span class="status-online">Online</span>' : '<span class="status-offline">Offline</span>';
                document.querySelector('.server-players').innerHTML = status.players.now;
            });
        </script>
    </body>
</html>