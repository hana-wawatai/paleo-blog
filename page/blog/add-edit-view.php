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

//~ Template for add-edit.php
// variables:
//  $errors - validation errors
//  $todo - submitted TODO
//  $edit - true for EDIT, false for ADD

function error_field($title, array $errors) {
    foreach ($errors as $error) {
        /* @var $error Error */
        if ($error->getSource() == $title) {

            return ' error-field';
        }
    }
    return '';
}

?>

<h1>
    <?php if ($edit): ?>
    Edit&nbsp;
    <?php else: ?>
    Add&nbsp;
    <?php endif; ?>
   Blog
</h1>

<?php if (!empty($errors)): ?>
<ul class="errors">
    <?php foreach ($errors as $error): ?>
        <?php /* @var $error Error */ ?>
        <li><?php echo $error->getMessage(); ?></li>
    <?php endforeach; ?>
</ul>
<?php endif; ?>

<form action="#" method="post">
    <fieldset>
        <div class="field">
            <label>title</label>

            <input type="text" name="blog[title]" value="<?php echo Utils::escape($blog->getTitle()); ?>"
                   class="text <?php echo error_field('blog_title', $errors); ?>"/>
        <label>description</label>
<input type="text" name="blog[description]" value="<?php echo Utils::escape($blog->getDescription()); ?>"
             class="text <?php echo error_field('blog_description', $errors); ?>"/>
 <label>content</label>        
<input type="text" name="blog[content]" value="<?php echo Utils::escape($blog->getContent()); ?>"
                   class="text <?php echo error_field('blog_content', $errors); ?>"/>
        
            &nbsp;
        </div>
        <div class="wrapper">

            <input type="submit" name="save" value="<?php echo $edit ? 'EDIT' : 'ADD'; ?>" class="submit" />
        </div>
    </fieldset>
</form>
