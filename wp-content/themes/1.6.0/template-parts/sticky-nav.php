<div class="sticky-nav">
    <?php if($u_slug=="particuliers"): ?>
        <?php if( have_rows('sticky_items_particuliers', 'option') ): ?>
            <ul role="list" class="sticky-list ">
                <?php while( have_rows('sticky_items_particuliers', 'option') ): the_row(); ?>
                  <li class="sticky-list-item">
                    <a href="<?php the_sub_field('lien'); ?>" class="sticky-list-link w-inline-block">
                      <img src="<?php the_sub_field('picto_lien'); ?>" aria-hidden=true loading="lazy" alt="" class="sticky-list-item-img">
                      <div class="sticky-list-item-txt"><?php the_sub_field('texte_lien'); ?></div>
                    </a>
                  </li>
                 <?php endwhile; ?>
            </ul>
        <?php endif; ?>
    <?php elseif($u_slug=="prescripteurs"): ?>
        <?php if( have_rows('sticky_items_prescripteurs', 'option') ): ?>
            <ul role="list" class="sticky-list ">
                <?php while( have_rows('sticky_items_prescripteurs', 'option') ): the_row(); ?>
                  <li class="sticky-list-item">
                    <a href="<?php the_sub_field('lien'); ?>" class="sticky-list-link w-inline-block">
                      <img src="<?php the_sub_field('picto_lien'); ?>" aria-hidden=true loading="lazy" alt="" class="sticky-list-item-img">
                      <div class="sticky-list-item-txt"><?php the_sub_field('texte_lien'); ?></div>
                    </a>
                  </li>
                 <?php endwhile; ?>
            </ul>
        <?php endif; ?>
    <?php elseif($u_slug=="pro-du-batiment"): ?>
        <?php if( have_rows('pro-du-batiment', 'option') ): ?>
            <ul role="list" class="sticky-list ">
                <?php while( have_rows('sticky_items_pro-du-batiment', 'option') ): the_row(); ?>
                  <li class="sticky-list-item">
                    <a href="<?php the_sub_field('lien'); ?>" class="sticky-list-link w-inline-block">
                      <img src="<?php the_sub_field('picto_lien'); ?>" aria-hidden=true loading="lazy" alt="" class="sticky-list-item-img">
                      <div class="sticky-list-item-txt"><?php the_sub_field('texte_lien'); ?></div>
                    </a>
                  </li>
                 <?php endwhile; ?>
            </ul>
        <?php endif; ?>
    <?php elseif($u_slug=="industriels"): ?>
        <?php if( have_rows('sticky_items_industriels', 'option') ): ?>
            <ul role="list" class="sticky-list ">
                <?php while( have_rows('sticky_items_industriels', 'option') ): the_row(); ?>
                  <li class="sticky-list-item">
                    <a href="<?php the_sub_field('lien'); ?>" class="sticky-list-link w-inline-block">
                      <img src="<?php the_sub_field('picto_lien'); ?>" aria-hidden=true loading="lazy" alt="" class="sticky-list-item-img">
                      <div class="sticky-list-item-txt"><?php the_sub_field('texte_lien'); ?></div>
                    </a>
                  </li>
                 <?php endwhile; ?>
            </ul>
        <?php endif; ?>
    <?php else: ?>
        <?php if( have_rows('sticky_items_crossnav', 'option') ): ?>
            <ul role="list" class="sticky-list ">
                <?php while( have_rows('sticky_items_crossnav', 'option') ): the_row(); ?>
                  <li class="sticky-list-item">
                    <a href="<?php the_sub_field('lien'); ?>" class="sticky-list-link w-inline-block">
                      <img src="<?php the_sub_field('picto_lien'); ?>" aria-hidden=true loading="lazy" alt="" class="sticky-list-item-img">
                      <div class="sticky-list-item-txt"><?php the_sub_field('texte_lien'); ?></div>
                    </a>
                  </li>
                 <?php endwhile; ?>
            </ul>
        <?php endif; ?>
    <?php endif; ?>
</div>
