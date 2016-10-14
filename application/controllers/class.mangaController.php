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

/**
 * Description of manga
 *
 * @author Wallace Osmar <wallace.osmar@r7.com>
 */
class mangaController extends Controller {
    
    public function index_any ( $slugname ) {
        $this->template->cache_lifetime = 600;
        if ( ! $this->template->isCached('manga/index.tpl', $slugname) ) {
            if ( is_null ( $mangaInfo = caching_get('mangaController-index-' . $slugname) ) ) {
                $mangaInfo = $this->model->Manga->selectBySlug( $slugname );
                caching_set('mangaController-index', $mangaInfo);
            }
            $this->template->assign('manga', $mangaInfo);
        }
        $this->template->display('manga/index.tpl', $slugname);
    }
    
}
