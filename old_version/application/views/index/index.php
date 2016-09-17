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
            <div class="row" >
                <div class="col-sm-9">
                    <div class="row">
                        
                        <div class="col-lg-12">
                            <div class="page-header">
                                <h1 id="tables"><?php echo sprintf( __('%d ultimos mangas'), $maxInsertManga );?></h1>
                            </div>
                            <div class="bs-component live-less-editor-hovercontainer">
                                <table class="table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th colspan="2"><?php _e('Manga');?></th>
                                            <th><?php _e('Ultimo cápitulo');?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach( (array) $insertManga as $manga ):?>
                                        <tr>
                                            <td style="background-image:url('<?php echo base_url("/image/compressed/{$manga->slug}/cover.jpg?w=100&h=142");?>');width:100px;height:100%;background-size: 100px; background-position:50% 30%; cursor: hand; cursor: pointer;" onclick="window.location = '<?php echo base_url("/manga/{$manga->slug}/");?>';"></td>
                                            <td>
                                                <h4>
                                                    <a href="<?php echo base_url( "/manga/{$manga->slug}/" );?>"><?php echo $manga->title;?></a>
                                                </h4>
                                            </td>
                                            <td><?php echo $manga->last_chapter?></td>
                                        </tr>
                                        <?php endforeach;?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        
                        <div class="col-lg-12">
                            
                            <div class="page-header">
                                <h1 id="tables"><?php echo sprintf( __('%d ultimos mangas atualizados.'), $maxUpdateManga );?></h1>
                            </div>
                            <div>
                                <?php foreach ( $updateManga as $manga ): ?>
                                <div>
                                    <span data-toggle="mangapop" manga-slug="<?php echo $manga->slug;?>" data-placement="right" data-original-title="<?php echo sprintf( '%s (%s)', $manga->title, $manga->released );?>" class="manga-2">
                                        <b><a href="<?php echo base_url("/manga/{$manga->slug}/");?>"><?php echo $manga->title;?></a></b>
                                    </span>
                                    <span class="pull-right">
                                        <i><time class="timeago" datetime="<?php echo $manga->last_update;?>"></time></i>
                                    </span>
                                    <br />
                                </div>
                                <?php endforeach;?>
                            </div>
                        </div>
                        
                    </div>
                </div>
                
                <div class="col-sm-3">
                    <h3><?php _e('Mangas mais populares.');?></h3>
                    <hr class="manga-hr">
                    <?php foreach( (array) $popularManga as $manga ):?>
                    <span class="thumbnail" data-toggle="mangapop" data-placement="left" manga-slug="<?php echo $manga->slug;?>" data-original-title="<?php echo sprintf('%s (%s)', $manga->title, $manga->released);?>" style="padding: 10px; margin: 3px">
                        <div class="media">
                            <a class="pull-left" href="<?php echo base_url("/manga/{$manga->slug}/");?>">
                                <img class="media-object img-thumb" src="<?php echo base_url("/image/compressed/{$manga->slug}/cover.jpg?w=100&h=142");?>" alt="<?php echo $manga->slug;?>">
                            </a>
                            <div class="media-body">
                                <h3 class="media-heading" id="tables">
                                    <a href="<?php echo base_url("/manga/{$manga->slug}/");?>"><?php echo $manga->title;?></a>
                                </h3>
                                <?php echo sprintf('Total de visualizações %s', $manga->views);?><br>
                            </div>
                        </div>
                    </span>
                    <?php endforeach;?>
                </div>
                
            </div>