<?php

/* 
 * Copyright (C) 2016 Avell G1511 MAX
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

function _parse( $array, $url ) {
    foreach( $array as $k => $value ) {
        $array[$k] = sprintf('<a href="%s">%s</a>', base_url( "/{$url}/" . urlencode($value) ), $value);
    }
    return $array;
}

?>
            <div style="margin-top: 30px;">
                <div class="row">
                    <div class="col-md-12">

                        <div class="row">
                            <div class="col-lg-8 col-sm-8" style="margin-bottom: 100px;">
                                <div class="page-header">
                                    <h1 id="tables"><?php echo sprintf('%s (%d)', strtoupper($manga->title), $manga->released);?></h1>
                                    <h4><?php echo implode(', ', $manga->other_name);?></h4>
                                </div>
                                <table class="table table-striped table-bordered table-hover">
                                    <tbody>
                                        <tr>
                                            <td><?php _e('Author(s)');?></td>
                                            <td><?php _e('Artist(s)');?></td>
                                            <td><?php _e('Genre(s)');?></td>
                                        </tr>
                                        <tr>
                                            <td><?php echo implode(', ', _parse($manga->authors, '/pages/manga-list/author'));?></td>
                                            <td><?php echo implode(', ', _parse($manga->artists, '/pages/manga-list/artist'));?></td>
                                            <td><?php echo implode(', ', _parse($manga->genres, '/pages/manga-list/genre'));?></td>
                                        </tr>
                                    </tbody>
                                </table>
                                <h2><?php _e('Sinopse');?></h2>
                                <p><?php echo $manga->description; ?></p>
                                <?php if( FALSE ):?>
                                <!-- -->
                                <div id="user_action_hide">
                                    <div class="btn-group">
                                        <a href="#" type="button" class="btn btn-primary"><i class="glyphicon glyphicon-upload"></i> <?php _e('Novo Capitulo');?></a>
                                        <a href="#" type="button" class="btn btn-primary"><i class="glyphicon glyphicon-wrench"></i> <?php _e('Editar');?></a>
                                    </div>
                                </div>
                                <!-- -->
                                <?php endif;?>
                                <h3><?php _e('Capitulo');?></h3>
                                <table class="table table-hover">
                                    <tbody>
                                        <?php
                                        if( count( $manga->chapters ) > 0 ):
                                            foreach( (array) $manga->chapters as $chapter ):?>
                                        <tr>
                                            <td><?php echo sprintf('<a href="%s"><b>%s %s</b> - %s</a>', base_url("/manga/{$manga->slug}/{$chapter->chapter}") ,$manga->name, $chapter->chapter, $chapter->name);?></td>
                                        </tr>
                                        <?php
                                            endforeach;
                                        else: ?>
                                        <tr>
                                            <td><?php _e('Não há nenhum capitulo');?></td>
                                        </tr>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-lg-4 col-sm-4" style="top: -70px;">
                                <img class="thumbnail" width="100%" src="<?php echo base_url("/image/compressed/{$manga->slug}/cover.jpg?w=360");?>">
                                <h3><?php _e('Status');?></h3>
                                <p><?php echo $manga->m_status;?>
                                </p>
                            </div>
                        </div>

                    </div>
                </div>
             </div>