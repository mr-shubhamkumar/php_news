<div id="footer">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <?php

                $setting_sql = "SELECT * from setting ";
                $setting_res = mysqli_query($con, $setting_sql);
                $set_row = mysqli_fetch_assoc($setting_res);

                ?>
                <span>© Copyright 2022 News | Powered by <a href="http://www.yahoobaba.net/"> <?php //echo $set_row['footerdesc']; 
                                                                                                ?> Shubham.kumar</a></span>
            </div>
        </div>
    </div>
</div>
</body>

</html>