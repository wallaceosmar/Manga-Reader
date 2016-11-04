{include file='_share/header.tpl'}
            <div class="row">
                <div class="col-sm-9">
                    <div class="row">
                        <div class="col-lg-12" style="min-height: 1467px;">
                            <div class="page-header" style="border-bottom:2px solid #efefef;">
                                <h1>{'Lista de Manga'|__}</h1>    
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
                                        <a href="{'manga-filter'|routing_generate:['controller' => 'pages', 'action' => 'manga-list', 'pagination' => $pagination->preview]|base_url}" aria-label="Previous">
                                            <span aria-hidden="true">&laquo;</span>
                                        </a>
                                    </li>
                                    {/if}
                                    {for $i = $pagination->beginFor to $pagination->endFor}
                                    <li><a href="{'manga-filter'|routing_generate:['controller' => 'pages', 'action' => 'manga-list', 'pagination' => $i]|base_url}">{$i}</a></li>
                                    {/for}
                                    {if $pagination->currentPage == $pagination->next }
                                    <li class="disabled">
                                        <span aria-hidden="true">&raquo;</span>
                                    </li>
                                    {else}
                                    <li>
                                        <a href="{'manga-filter'|routing_generate:['controller' => 'pages', 'action' => 'manga-list', 'pagination' => $pagination->next]|base_url}" aria-label="Next">
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
                <div class="col-lg-3" style="margin-top: 50px;">
                    
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            <h3 class="panel-title">{'Listar por Status'|__}</h3>
                        </div>
                        <div class="list-group">
                            <a href="{'manga-filter'|routing_generate:['controller' => 'pages', 'action' => 'manga-list']|base_url}" class="list-group-item">{'Tudo'|__}</a>
                            <a href="{'manga-filter'|routing_generate:['controller' => 'pages', 'action' => 'manga-list', 'filter' => 'status', 'name' => 'completed']|base_url}" class="list-group-item">{'Completo'|__}</a>
                            <a href="{'manga-filter'|routing_generate:['controller' => 'pages', 'action' => 'manga-list', 'filter' => 'status', 'name' => 'on-going']|base_url}" class="list-group-item">{'Em andamento'|__}</a> 
                        </div>
                    </div>	
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            <h3 class="panel-title">{'Listar por genero'|__}</h3>
                        </div>
                        <div class="list-group">
                            {foreach $manga_genre as $genre}
                            {assign "url" $genre|urlencode}
                            <a href="{'manga-filter'|routing_generate:['controller' => 'pages', 'action' => 'manga-list', 'filter' => 'genre', 'name' => $url ]|base_url}" class="list-group-item">{$genre}</a>
                            {/foreach}
                        </div>
                    </div>	
                    
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h3 class="panel-title">{'Statisticas'|__}</h3>
                        </div>
                        <div>
                            <ul class="list-group">
                                <li class="list-group-item"><span class="badge badge-success">{$statisticas->mangas}</span>{'Mangas'|__}</li>
                                <li class="list-group-item"><span class="badge badge-danger">{$statisticas->chapters}</span>{'Capitulos'|__}</li>
                                <li class="list-group-item"><span class="badge badge-info">{$statisticas->views}</span>{'Total de visualizaçoes'|__}</li>
                            </ul>
                        </div>
                    </div>
                    
                </div>
            </div>
{include file='_share/footer.tpl'}