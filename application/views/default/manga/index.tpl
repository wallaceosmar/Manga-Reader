{function _parse array='' url='' filter=''}
    {foreach $array as $k => $b}{if $k gt 0}, {/if}<a href="{$url|routing_generate:[ 'controller' => 'pages', 'action' => 'manga-list', 'filter' => $filter, 'name' => $b|@urlencode ]|base_url}">{$b}</a>{foreachelse}N:A{/foreach}
{/function}
{include file='_share/header.tpl'}
            <div style="margin-top: 30px;">
                <div class="row">
                    <div class="col-md-12">

                        <div class="row">
                            <div class="col-lg-8 col-sm-8" style="margin-bottom: 100px;">
                                <div class="page-header">
                                    <h1 id="tables">{$manga->title|strtoupper} ({$manga->released})</h1>
                                    <h4>{$manga->other_name|implode:', '}</h4>
                                </div>
                                <table class="table table-striped table-bordered table-hover">
                                    <tbody>
                                        <tr>
                                            <td>{'Author(s)'|__}</td>
                                            <td>{'Artista(s)'|__}</td>
                                            <td>{'Genero(s)'|__}</td>
                                        </tr>
                                        <tr>
                                            <td>{_parse array=$manga->authors url='manga-filter' filter='author'}</td>
                                            <td>{_parse array=$manga->artists url='manga-filter' filter='artist'}</td>
                                            <td>{_parse array=$manga->genres url='manga-filter' filter='genre'}</td>
                                        </tr>
                                    </tbody>
                                </table>
                                <h2>{'Sinopse'|__}</h2>
                                <p>{$manga->description}</p>
                                {if FALSE }
                                <!-- -->
                                <div id="user_action_hide">
                                    <div class="btn-group">
                                        <a href="#" type="button" class="btn btn-primary"><i class="glyphicon glyphicon-upload"></i> {'Novo Capitulo'|__}</a>
                                        <a href="#" type="button" class="btn btn-primary"><i class="glyphicon glyphicon-wrench"></i> {'Editar'|__}</a>
                                    </div>
                                </div>
                                <!-- -->
                                {/if}
                                <h3>{'Capitulo'|__}</h3>
                                <table class="table table-hover">
                                    <tbody>
                                        {foreach $manga->chapters as $chapter }
                                        <tr>
                                            <td>
                                                <a href="{'manga-reader'|routing_generate:[ 'slugname' => $manga->slug, '' => $chapter->chapter ]|base_url}"><b>{$manga->name} {$chapter->chapter}</b> - {$chapter->name}</a>
                                            </td>
                                        </tr>
                                        {foreachelse}
                                        <tr>
                                            <td>{'Não há nenhum capitulo'|__}</td>
                                        </tr>
                                        {/foreach}
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-lg-4 col-sm-4" style="top: -70px;">
                                <img class="thumbnail" width="100%" src="{'image-cover'|routing_generate:['slugname' => $manga->slug]|base_url}?w=360"">
                                <h3>{'Status'|__}</h3>
                                <p>{$manga->m_status}</p>
                            </div>
                        </div>

                    </div>
                </div>
             </div>
{include file='_share/footer.tpl'}