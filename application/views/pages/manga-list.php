<?php

/* 
 * Copyright (C) 2016 Wallace Osmar
 *
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation; either version 2
 * of the License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 59 Temple Place - Suite 330, Boston, MA  02111-1307, USA.
 */

?>
            <div class="row">
                <div class="col-sm-9">
                    <div class="row">
                        <div class="col-lg-12" style="min-height: 1467px;">
                            <div class="page-header" style="border-bottom:2px solid #efefef;">
                                <h1>Manga List</h1>    
                            </div>
                            <?php if( count( $listManga ) > 0 ):?>
                            <ul class="manga-list">
                                <?php foreach( (array) $listManga as $manga ):?>
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
                    <div class="row">
                        <div class="col-lg-12">
                            <?php if( $pagination->enable ):?>
                            <nav style="text-align: center;">
                                <ul class="pagination">
                                    <?php if(($pagination->currentPage+1) == $pagination->preview ): ?>
                                    <li class="disabled">
                                        <span aria-hidden="true">&laquo;</span>
                                    </li>
                                    <?php else:?>
                                    <li>
                                        <a href="<?php echo base_url( sprintf( $pagination->url , $pagination->preview ) );?>" aria-label="Previous">
                                            <span aria-hidden="true">&laquo;</span>
                                        </a>
                                    </li>
                                    <?php endif;?>
                                    <?php for( $i = $pagination->beginFor; $i < $pagination->endFor+1; $i++ ):?>
                                    <li><a href="<?php echo base_url( sprintf( $pagination->url , $i ) );?>"><?php echo $i;?></a></li>
                                    <?php endfor;?>
                                    <?php if(($pagination->currentPage+1) == $pagination->next):?>
                                    <li class="disabled">
                                        <span aria-hidden="true">&raquo;</span>
                                    </li>
                                    <?php else:?>
                                    <li>
                                        <a href="<?php echo base_url( sprintf( $pagination->url , $pagination->next ) );?>" aria-label="Next">
                                            <span aria-hidden="true">&raquo;</span>
                                        </a>
                                    </li>
                                    <?php endif;?>
                                </ul>
                            </nav>
                            <?php endif;?>
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
                    
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h3 class="panel-title"><?php _e('Statisticas');?></h3>
                        </div>
                        <div>
                            <ul class="list-group">
                                <li class="list-group-item"><span class="badge badge-success"><?php echo $statistc->mangas;?></span>Mangas</li>
                                <li class="list-group-item"><span class="badge badge-danger"><?php echo $statistc->chapters;?></span>Chapters</li>
                                <li class="list-group-item"><span class="badge badge-info"><?php echo $statistc->views;?></span>Total views</li>
                            </ul>
                        </div>
                    </div>
                    
                </div>
            </div>