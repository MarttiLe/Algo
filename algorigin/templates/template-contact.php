<?php
/**
* Template Name: Contact page
*/
?>

<?php
    $page_data = get_field('contact_options');
?>

<?php get_header(); ?>


<?php
    $has_heading = get_field('display_block_page_heading');
    if($has_heading) {
        $block_attr = [];
        get_template_part('templates/blocks/page-heading', null, $block_attr);
    }
?>


<div class="contact page-content">
    <div class="container">
                
        <?php if(!$has_heading) : ?>
        <h1 class="page-content__title h1"><?php the_title(); ?></h1>    
        <?php endif; ?>

        <?php if(!empty($page_data['content_before'])) : ?>
        <div class="contact__content-before editor-content">
            <?php echo $page_data['content_before']; ?>
        </div>
        <?php endif; ?>

        <ul class="contact__items">
            <li class="contact__item">
                <div class="contact-item">
                    <?php icon_svg('phone', 'contact-item__icon'); ?>
                    <a href="tel:<?php echo theme_get_formatted_tel($page_data['phone']['phone_nr']); ?>" class="contact-item__link"><?php echo $page_data['phone']['phone_nr']; ?></a>
                    <p class="contact-item__text"><?php echo $page_data['phone']['text']; ?></p>
                </div>
            </li>

            <li class="contact__item">
                <div class="contact-item">
                    <?php icon_svg('mail', 'contact-item__icon'); ?>
                    <a href="mailto:<?php echo antispambot($page_data['email']['email_address']); ?>" class="contact-item__link"><?php echo antispambot($page_data['email']['email_address']); ?></a>
                    <p class="contact-item__text"><?php echo $page_data['email']['text']; ?></p>
                </div>
            </li>

            <li class="contact__item">
                <div class="contact-item">
                    <?php icon_svg('marker', 'contact-item__icon'); ?>
                    <a href="<?php echo $page_data['address']['google_maps_url']; ?>" class="contact-item__link"><?php echo $page_data['address']['address']; ?></a>
                    <p class="contact-item__text"><?php echo $page_data['address']['text']; ?></p>
                </div>
            </li>
        </ul>
        
        <?php if(!empty($page_data['contact_form'])) : ?>
        <div class="contact__form editor-content">
            <?php echo $page_data['contact_form']; ?>
        </div>
        <?php endif; ?>

        <?php if(!empty($page_data['content_after'])) : ?>
        <div class="contact__content-after editor-content">
            <?php echo $page_data['content_after']; ?>
        </div>
        <?php endif; ?>

        <div class="editor-content">
            <?php the_content(); ?>
        </div>

    </div>
</div>


<?php get_footer(); ?>