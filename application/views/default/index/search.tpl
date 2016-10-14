{include file='_share/header.tpl'}            
            <div class="row">
                <div class="col-sm-9">
                    <div class="row">
                        <div class="col-lg-12" style="min-height: 1467px;">
                            <div class="page-header" style="border-bottom:2px solid #efefef;">
                                <h1>{'Pesquisa'|__}</h1>    
                            </div>
                            {if $searchManga|@count gt 0 }
                            <ul class="manga-list">
                                {foreach $searchManga as $manga}
                                <li>
                                    <a class="manga-list-img" href="{'manga-info'|routing_generate:['slugname' => $manga->slug]|base_url}" rel="{$manga->id}">
                                        <div style="float:left;overflow:hidden">
                                            <img src="{'image-cover'|routing_generate:['slugname' => $manga->slug ]}?w=100&h=142" width="100" />
                                        </div>
                                    </a>
                                    <div class="manga-list-text">
                                        <a class="title" href="{'manga-info'|routing_generate:[ 'slugname' => $manga->slug ]|base_url}" rel="{$manga->id}">{$manga->title}</a>
                                        <p class="info">{'%d visualizações'|__|sprintf:$manga->views}</p>
                                    </div>
                                </li>
                                {/foreach}
                            </ul>
                            {else}
                            <div>
                                <p>{'Não ha nenhum manga cadastrado.'|__}</p>
                            </div>
                            {/if}
                        </div>
                    </div>
                </div>
                <div class="col-lg-3" style="margin-top: 50px;">
                    
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            <h3 class="panel-title">{'Listar por Status'|__}</h3>
                        </div>
                        <div class="list-group">
                            <a href="{'/pages/manga-list'|base_url}" class="list-group-item">{'Todos'|__}</a>
                            <a href="{'/pages/manga-list/status/completed'|base_url}" class="list-group-item">{'Completo'|__}</a>
                            <a href="{'/pages/manga-list/status/on-going'|base_url}" class="list-group-item">{'Em Andamento'|__}</a> 
                        </div>
                    </div>
                    
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            <h3 class="panel-title">{'Listar por genero'|__}</h3>
                        </div>
                        <div class="list-group">
                            {foreach $mangaGenreList as $v }
                            <a href="{'manga-filter'|routing_generate:['controller' => 'pages', 'action' => 'manga-list', 'filter' => 'genre', 'name' => $v ]|base_url}" class="list-group-item">{$v}</a>
                            {/foreach}
                        </div>
                    </div>
                    
                </div>
            </div>
{include file='_share/footer.tpl'}