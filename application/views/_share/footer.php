<?php

/* 
 * The MIT License
 *
 * Copyright 2016 Wallace Osmar https://github.com/wallaceosmar.
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */

?>
            <!-- END PAGE CONTENT -->
            
            <!-- Begin Footer -->
            <footer class="footer">

                <div class="row">
                    <div class="col-lg-12">
                        <ul class="list-unstyled">
                            <li class="pull-right"><a href="#top">Back to top</a></li>
                            <!-- BEGIN CUSTOM BOTTOM LINK -->
                            <?php foreach( (array) get_menu('bottom-link') as $item ):?>
                            <li><a href="<?php echo $item->url;?>"><?php echo $item->title;?></a></li>
                            <?php endforeach;?>
                            <!-- -->
                        </ul>
                        <!-- COPY RIGHT -->
                        <p><?php echo sprintf( __('Copyright &COPY; %1$s - %2$s %3$s. Todos os direitor reservados.'), date('Y'), date('Y'), 'MangaReader');?></p>
                    </div>
                </div>
                <strong>Powered by <a href="https://github.com/wallaceosmar">wallaceosmar</a></strong>
            </footer>
            <!-- End Footer -->
        </div>
        <!-- End Container -->
        
        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="<?php echo base_content_url('/bootstrap/js/bootstrap.min.js')?>"></script>
        <!-- -->
        <script>
            var MangaReaderOptions = {
                URL_ADMIN_PAGE: '<?php echo base_url('/admin/')?>'
            }
        </script>
        <?php template_footer();?>
        <!-- MangaReader Application -->
        <script src="<?php echo base_content_url('/js/mangareader.js');?>"></script>
    </body>
</html>