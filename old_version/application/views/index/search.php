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
//$searchManga;
?>
            <div class="row">
                <div class="col-sm-9">
                    <div class="row">
                        <div class="col-lg-12" style="min-height: 1467px;">
                            <div class="page-header" style="border-bottom:2px solid #efefef;">
                                <h1><?php _e('Pesquisa');?></h1>    
                            </div>
                            <?php if( count( $searchManga ) > 0 ):?>
                            <ul class="manga-list">
                                <?php foreach( (array) $searchManga as $manga ):?>
                                <li>
                                    <a class="manga-list-img" href="<?php echo base_url("/manga/{$manga->slug}");?>" rel="15291">
                                        <div style="float:left;overflow:hidden">
                                            <img src="<?php echo base_url("/image/compressed/{$manga->slug}/cover.jpg?w=100&h=142");?>" width="100" />
                                        </div>
                                    </a>
                                    <div class="manga-list-text">
                                        <a class="title" href="<?php echo base_url("/manga/{$manga->slug}");?>" rel="15291"><?php echo $manga->title;?></a>
                                        <p class="info"> <?php echo sprintf( __('%d vizualizações') , $manga->views )?></p>
                                    </div>
                                </li>
                                <?php endforeach;?>
                            </ul>
                            <?php else:?>
                            <div>
                                <p><?php _e('Não ha nenhum manga cadastrado.');?></p>
                            </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3" style="margin-top: 50px;">
                    
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            <h3 class="panel-title"><?php _e('Listar por Status');?></h3>
                        </div>
                        <div class="list-group">
                            <a href="<?php echo base_url('/pages/manga-list');?>" class="list-group-item">All</a>
                            <a href="<?php echo base_url('/pages/manga-list/status/completed');?>" class="list-group-item">Completed</a>
                            <a href="<?php echo base_url('/pages/manga-list/status/on-going');?>" class="list-group-item">On going</a> 
                        </div>
                    </div>
                    
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            <h3 class="panel-title">List by genre</h3>
                        </div>
                        <div class="list-group">
                            <?php foreach( (array) get_option('app_manga_genre') as $v ):?>
                            <a href="<?php echo base_url("/pages/manga-list/genre/" . urlencode($v));?>" class="list-group-item"><?php echo $v;?></a>
                            <?php endforeach;?>
                        </div>
                    </div>
                    
                </div>
            </div>