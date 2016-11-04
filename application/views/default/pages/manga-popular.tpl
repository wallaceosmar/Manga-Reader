{include file='_share/header.tpl'}
            <div class="row">
                <div class="col-sm-12">
                    <div class="row">
                        <div class="col-lg-8" style="min-height: 200px;">
                            <div class="page-header" style="border-bottom:2px solid #efefef;">
                                <h1>{'Lista de Mangas mais populares'|__}</h1>    
                            </div>
                            {if $listManga|@count gt 0}
                            <ul class="manga-list">
                                {foreach $listManga as $manga }
                                <li>
                                    <a class="manga-list-img" href="{'manga-info'|routing_generate:[ 'slugname' => $manga->slug]|base_url}">
                                        <div style="float:left;overflow:hidden">
                                            <img src="{'image-cover'|routing_generate:[ 'slugname' => $manga->slug ]|base_url}?w=100&h=142" />
                                        </div>
                                    </a>
                                    <div class="manga-list-text">
                                        <a class="title" href="{'manga-info'|routing_generate:[ 'slugname' => $manga->slug]|base_url}" >{$manga->title}</a>
                                        <p class="info"> {'%d vizualizações'|sprintf:[ $manga->views ]}</p>
                                    </div>
                                </li>
                                {/foreach}
                            </ul>
                            {else}
                            <div>
                                <p>{'Não ha nenhum manga cadastrado.'}</p>
                            </div>
                            {/if}
                        </div>
                    </div>
                    {if isset( $pagination ) && $pagination->enabled }
                    <div class="row">
                        <div class="col-lg-12">
                            <nav style="text-align: center;">
                                <ul class="pagination">
                                    {if $pagination->currentPage == $pagination->preview}
                                    <li class="disabled">
                                        <span aria-hidden="true">&laquo;</span>
                                    </li>
                                    {else}
                                    <li>
                                        <a href="{'manga-filter'|routing_generate:['controller' => 'pages', 'action' => 'manga-popular', 'pagination' => $pagination->preview]|base_url}" aria-label="Previous">
                                            <span aria-hidden="true">&laquo;</span>
                                        </a>
                                    </li>
                                    {/if}
                                    {for $i = $pagination->beginFor to $pagination->endFor}
                                    <li><a href="{'manga-filter'|routing_generate:['controller' => 'pages', 'action' => 'manga-popular', 'pagination' => $i]|base_url}">{$i}</a></li>
                                    {/for}
                                    {if $pagination->currentPage == $pagination->next }
                                    <li class="disabled">
                                        <span aria-hidden="true">&raquo;</span>
                                    </li>
                                    {else}
                                    <li>
                                        <a href="{'manga-filter'|routing_generate:['controller' => 'pages', 'action' => 'manga-popular', 'pagination' => $pagination->next]|base_url}" aria-label="Next">
                                            <span aria-hidden="true">&raquo;</span>
                                        </a>
                                    </li>
                                    {/if}
                                </ul>
                            </nav>
                            
                        </div>
                    </div>
                    {/if}
                </div>
            </div>
{include file='_share/footer.tpl'}