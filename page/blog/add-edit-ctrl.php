<?php

/*
 * DO NOT ALTER OR REMOVE COPYRIGHT NOTICES OR THIS HEADER.
 *
 * Copyright 2011 Oracle and/or its affiliates. All rights reserved.
 *
 * Oracle and Java are registered trademarks of Oracle and/or its affiliates.
 * Other names may be trademarks of their respective owners.
 *
 * The contents of this file are subject to the terms of either the GNU
 * General Public License Version 2 only ("GPL") or the Common
 * Development and Distribution License("CDDL") (collectively, the
 * "License"). You may not use this file except in compliance with the
 * License. You can obtain a copy of the License at
 * http://www.netbeans.org/cddl-gplv2.html
 * or nbbuild/licenses/CDDL-GPL-2-CP. See the License for the
 * specific language governing permissions and limitations under the
 * License.  When distributing the software, include this License Header
 * Notice in each file and include the License file at
 * nbbuild/licenses/CDDL-GPL-2-CP.  Oracle designates this
 * particular file as subject to the "Classpath" exception as provided
 * by Oracle in the GPL Version 2 section of the License file that
 * accompanied this code. If applicable, add the following below the
 * License Header, with the fields enclosed by brackets [] replaced by
 * your own identifying information:
 * "Portions Copyrighted [year] [name of copyright owner]"
 *
 * If you wish your version of this file to be governed by only the CDDL
 * or only the GPL Version 2, indicate your decision by adding
 * "[Contributor] elects to include this software in this distribution
 * under the [CDDL or GPL Version 2] license." If you do not indicate a
 * single choice of license, a recipient has the option to distribute
 * your version of this file under either the CDDL, the GPL Version 2 or
 * to extend the choice of license to its licensees as provided above.
 * However, if you add GPL Version 2 code and therefore, elected the GPL
 * Version 2 license, then the option applies only if the new code is
 * made subject to such option by the copyright holder.
 *
 * Contributor(s):
 *
 * Portions Copyrighted 2011 Sun Microsystems, Inc.
 */
$headTemplate = new HeadTemplate('Add/Edit | BlogList', 'Edit or add a blog');
$errors = array();
$blog = null;
$edit = array_key_exists('id', $_GET);

if ($edit) {
    $dao = new BlogDao();
   
    $blog = Utils::getObjByGetId($dao);
} else {
 
    // set defaults
    $blog = new Blog();
   
    $blog->setTitle ('');
    $blog->setContent('');
  
    $blog->setDescription('');
  
    $date_created = new DateTime("+1 day");
   
    $date_created->setTime(0, 0, 0);
  
    $blog->setDateCreated($date_created);
  
    $blog->setStatus('pending');
    
    $user_id = 1;
    
    $blog->setUserId($userId);
  
}
//if (array_key_exists('cancel', $_POST)) {
//    // redirect
//    Utils::redirect('detail', array('id' => $blog->getId()));
//} 
//else
if (array_key_exists('save', $_POST)) {
    // for security reasons, do not map the whole $_POST['todo']
    $data = array(
        'title' => $_POST['blog']['title'],
        'description' => $_POST['blog']['description'],
//        'date_created' => $_POST['blog']['date_created'] . ' 00:00:00',
        'content' => $_POST['blog']['content']
    );
    // map
    
    BlogMapper::map($blog, $data);
   
    // validate
    $errors = BlogValidator::validate($blog);
    // validate
   
    if (empty($errors)) {
        // save
        $dao = new BlogDao();
        $blog = $dao->save($blog);
        Flash::addFlash('Blog post has saved successfully.');
        // redirect
        Utils::redirect('list', array('module' => 'blog'));
    }
}
