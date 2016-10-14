            <!-- END PAGE CONTENT -->
            
            <!-- Begin Footer -->
            <footer class="footer">
                <div class="row">
                    <div class="col-lg-12">
                        <ul class="list-unstyled">
                            <li class="pull-right"><a href="#top">{'Voltar ao topo'|__}</a></li>
                            <!-- BEGIN CUSTOM BOTTOM LINK -->
                            {foreach get_menu('bottom-link') as $item }
                            <li><a href="{$item->url}">{$item->title}</a></li>
                            {/foreach}
                            <!-- END CUSTOM BOTTOM LINK -->
                        </ul>
                        <!-- COPY RIGHT -->
                        <p>Copyright &COPY; 2016 - {'Y'|date} MangaReader. {'Todos os direitor reservados.'|__}</p>
                    </div>
                </div>
                <strong>Powered by <a href="https://github.com/wallaceosmar">wallaceosmar</a></strong>
            </footer>
            <!-- End Footer -->
        </div>
        <!-- End Container -->
        
        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="{'/js/jQuery/jquery-2.2.3.min.js'|content_base_url}"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="{'/js/bootstrap.min.js'|content_base_url}"></script>
        <!-- MangaReader Application -->
        <script src="{'/js/mangareader.js'|content_base_url}"></script>
    </body>
</html>