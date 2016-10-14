{include file='_share/header.tpl'}
            
            <div class="row" >
                <div class="col-sm-9">
                    <div class="row">
                        
                        <div class="col-lg-12">
                            <div class="page-header">
                                <h1 id="tables">{'%d ultimos mangas'|__|sprintf:$maxInsertManga}</h1>
                            </div>
                            <div class="bs-component live-less-editor-hovercontainer">
                                <table class="table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th colspan="2">{'Manga'|__}</th>
                                            <th>{'Ultimo cápitulo'|__}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        {foreach $insertManga as $manga }
                                        <tr>
                                            <td style="background-image:url('{'image-cover'|routing_generate:['slugname' => $manga->slug]|base_url}');width:100px;height:100%;background-size: 100px; background-position:50% 30%; cursor: hand; cursor: pointer;" onclick="window.location = '{'manga-info'|routing_generate:[ 'slugname'=> $manga->slug ]|base_url}';"></td>
                                            <td><h4><a href="{'manga-info'|routing_generate:['slugname' => $manga->slug]|base_url}">{$manga->title}</a></h4></td>
                                            <td>{$manga->last_chapter}</td>
                                        </tr>
                                        {foreachelse}
                                        <tr>
                                            <td colspan="3">{'Nenhum manga encontrado.'|__}</td>    
                                        </tr>
                                        {/foreach}
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        
                        <div class="col-lg-12">
                            
                            <div class="page-header">
                                <h1 id="tables">{'%d ultimos mangas atualizados.'|__|sprintf:$maxUpdateManga}</h1>
                            </div>
                            <div>
                                {foreach  $updateManga as $manga }
                                <div>
                                    <span data-toggle="mangapop" manga-slug="{$manga->slug}" data-placement="right" data-original-title="{'%s (%s)'|sprintf:$manga->title:$manga->released}" class="manga-2">
                                        <b><a href="{'manga-info'|routing_generate:['slugname'=>$manga->slug]|base_url}">{$manga->title}</a></b>
                                    </span>
                                    <span class="pull-right">
                                        <i><time class="timeago" datetime="{$manga->last_update}"></time></i>
                                    </span>
                                    <br />
                                </div>
                                {foreachelse}
                                <div>
                                    <span>{'Nenhum manga encontrado'|__}</span>
                                </div>
                                {/foreach}
                            </div>
                        </div>
                        
                    </div>
                </div>
                
                <div class="col-sm-3">
                    <h3>{'Mangas mais populares.'|__}</h3>
                    <hr class="manga-hr">
                    {foreach $popularManga as $manga}
                    <span class="thumbnail" data-toggle="mangapop" data-placement="left" manga-slug="{$manga->slug}" data-original-title="{'%s (%s)'|__|sprintf:$manga->title:$manga->released}" style="padding: 10px; margin: 3px">
                        <div class="media">
                            <a class="pull-left" href="{'manga-info'|routing_generate:[ 'slugname' => $manga->slug]|base_url}">
                                <img class="media-object img-thumb" src="{'image-cover'|routing_generate:['slugname' => $manga->slug]|base_url}" alt="{$manga->slug}">
                            </a>
                            <div class="media-body">
                                <h3 class="media-heading" id="tables">
                                    <a href="{'manga-info'|routing_generate:['slugname' => $manga->slug]|base_url}">{$manga->title}</a>
                                </h3>
                                {'Total de visualizações %s'|sprintf:$manga->views}<br>
                            </div>
                        </div>
                    </span>
                    {foreachelse}
                    <span class="thumbnail">{'Nenhum manga encontrado.'|__}</span>
                    {/foreach}
                </div>
                
            </div>
{include file='_share/footer.tpl'}