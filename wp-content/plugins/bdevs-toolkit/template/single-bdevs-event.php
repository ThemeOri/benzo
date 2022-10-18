<?php 
/** 
 * The main template file
 *
 * @package  WordPress
 * @subpackage  medidove
 */
get_header(); ?>

      <div class="event-detalis-area pt-120 pb-70">
         <div class="container">
            <div class="row">
               <?php 
                  if( have_posts() ):
                    while( have_posts() ): the_post();
                    $categories = get_the_terms( get_the_id(), 'event-categories' );
                    $event_details_thumb = function_exists('get_field') ? get_field('event_details_thumb') : ''; 
                    $host_image = function_exists('get_field') ? get_field('host_image') : ''; 
                    $host_name = function_exists('get_field') ? get_field('host_name') : ''; 
                    $audience_joined = function_exists('get_field') ? get_field('audience_joined') : ''; 
                    $estimated_seat = function_exists('get_field') ? get_field('estimated_seat') : ''; 
                       
               ?>
               <div class="col-xl-8 col-lg-12">
                  <div class="event-main-wrapper mb-30">
                     <div class="course-detelis-meta mb-30">
                        <div class="course-meta-wrapper border-line-meta">
                           <div class="course-meta-img">
                              <img src="<?php echo esc_html($host_image['url']); ?>"
                                    alt="<?php echo esc_attr__('Speaker:','bdevs-toolkit'); ?>">
                           </div>
                           <div class="course-meta-text">
                              <span><?php echo esc_html__('Hosted by','bdevs-toolkit'); ?></span>
                              <h6><?php echo esc_html($host_name); ?></h6>
                           </div>
                        </div>
                        <div class="course-Enroll border-line-meta">
                           <p><?php echo esc_html__('Total Joined','bdevs-toolkit'); ?></p>
                           <span><?php echo esc_html($audience_joined); ?></span>
                        </div>
                        <div class="course-update border-line-meta">
                           <p><?php echo esc_html__('Estimated Seat','bdevs-toolkit'); ?></p>
                           <span><?php echo esc_html($estimated_seat); ?></span>
                        </div>
                        <?php if (!empty($categories)) : ?> 
                        <div class="course-category">
                           <p><?php echo esc_html__('Category','bdevs-toolkit'); ?></p>
                           <?php foreach ( $categories as $category ) : ?>
                           <span><a href="<?php echo esc_url( get_category_link( $category->term_id)); ?>"><?php echo esc_html($category->name); ?></a></span>
                           <?php endforeach; ?>
                        </div>
                        <?php endif; ?>
                     </div>
                     <div class="event-details-thumb w-img mb-20">
                        <?php the_post_thumbnail(); ?>
                     </div>
                     <div class="event-contact-info">
                        <h2><?php the_title(); ?></h2>
                     </div>
                     <div class="event-introduction">
                        <div class="introduction-info mb-40">
                          <?php the_content(); ?>
                        </div>
                     </div>
                  </div>
               </div>
               <?php 
                endwhile; wp_reset_query();
                endif; 
               ?>

               <?php 
                    if( have_posts() ):
                      while( have_posts() ): the_post();
                       $categories = get_the_terms( get_the_id(), 'event-categories' );
                       $speaker_image = function_exists('get_field') ? get_field('speaker_image') : ''; 
                       $speaker_name = function_exists('get_field') ? get_field('speaker_name') : ''; 
                       $designation = function_exists('get_field') ? get_field('designation') : ''; 
                       $event_price = function_exists('get_field') ? get_field('event_price') : ''; 
                       $event_price = function_exists('get_field') ? get_field('event_price') : ''; 
                       $date_text = function_exists('get_field') ? get_field('date_text') : ''; 
                       $event_start_time = function_exists('get_field') ? get_field('event_start_time') : ''; 
                       $address_text = function_exists('get_field') ? get_field('address_text') : ''; 
                       $language = function_exists('get_field') ? get_field('language') : ''; 
                       $estimated_seat = function_exists('get_field') ? get_field('estimated_seat') : ''; 
                       $event_button_text = function_exists('get_field') ? get_field('event_button_text') : ''; 
                       $event_button_url = function_exists('get_field') ? get_field('event_button_url') : ''; 
                       $sponsor_image = function_exists('get_field') ? get_field('sponsor_image') : ''; 
                  ?>
                  <div class="col-xl-4 col-lg-8 col-md-8">
                     <div class="sidebar-widget-wrapper">
                        <div class="event-speaker-wrapper mb-30">
                           <div class="event-speaker-info">
                              <h4><?php echo esc_html__('Speaker','bdevs-toolkit') ?></h4>
                           </div>
                           <div class="event-sidebar-thumb w-img">
                              <img src="<?php echo esc_html($speaker_image['url']); ?>" alt="<?php echo esc_attr__('Speaker:','bdevs-toolkit'); ?>">
                           </div>
                           <div class="event-speaker-content text-center">
                              <span><?php echo esc_html($speaker_name); ?></span>
                              <p><?php echo esc_html($designation); ?></p>
                           </div>
                        </div>
                        <div class="event-information-wrapper mb-30">
                           <div class="event-price-info">
                              <div class="event-ticket-cost">
                                 <span><?php echo esc_html__('Ticket Costs:','bdevs-toolkit'); ?></span>
                              </div>
                              <div class="event-price">
                                 <span><?php echo esc_html($event_price); ?></span>
                              </div>
                           </div>
                           <div class="event-information-list">
                              <ul>
                                 <li>
                                    <div class="information-list">
                                       <i class="flaticon-calendar"></i>
                                       <span><?php echo esc_html__('Date','bdevs-toolkit'); ?></span>
                                    </div>
                                    <div class="information-list">
                                       <span><?php echo esc_html($date_text); ?></span>
                                    </div>
                                 </li>
                                 <li>
                                    <div class="information-list">
                                       <i class="fal fa-clock"></i>
                                       <span><?php echo esc_html__('Schedule','bdevs-toolkit'); ?></span>
                                    </div>
                                    <div class="information-list">
                                       <span><?php echo esc_html($event_start_time); ?></span>
                                    </div>
                                 </li>
                                 <li>
                                    <div class="information-list">
                                       <i class="fal fa-map-marker-alt"></i>
                                       <span><?php echo esc_html__('Location','bdevs-toolkit'); ?></span>
                                    </div>
                                    <div class="information-list">
                                       <span><?php echo esc_html($address_text); ?></span>
                                    </div>
                                 </li>
                                 <li>
                                    <div class="information-list">
                                       <i class="fal fa-border-all"></i>
                                       <span><?php echo esc_html__('Category','bdevs-toolkit'); ?></span>
                                    </div>
                                    <?php if (!empty($categories)) : ?>
                                    <div class="information-list cat">
                                       <?php foreach ( $categories as $category ) : ?>
                                       <span><a href="<?php echo esc_url( get_category_link( $category->term_id)); ?>"><?php echo esc_html($category->name); ?></a></span>
                                       <?php endforeach; ?>
                                    </div>
                                    <?php endif; ?>
                                 </li>
                                 <li>
                                    <div class="information-list">
                                       <i class="fal fa-globe"></i>
                                       <span><?php echo esc_html__('Laguage','bdevs-toolkit'); ?></span>
                                    </div>
                                    <div class="information-list">
                                       <span><?php echo esc_html($language); ?></span>
                                    </div>
                                 </li>
                                 <li>
                                    <div class="information-list">
                                       <i class="fal fa-bookmark"></i>
                                       <span><?php echo esc_html__('Estimated Seat','bdevs-toolkit'); ?></span>
                                    </div>
                                    <div class="information-list">
                                       <span><?php echo esc_html($estimated_seat); ?></span>
                                    </div>
                                 </li>
                              </ul>
                           </div>
                           <?php if(!empty($event_button_text)) : ?>
                           <a href="<?php echo esc_html($event_button_url); ?>" class="event-btn"><?php echo esc_html($event_button_text); ?></a>
                           <?php endif; ?>
                        </div>

                        <div class="event-sponsor-wrapper mb-30">
                           <div class="sopnsor-tittle">
                              <h4><?php echo esc_html__('Sponsor by','bdevs-toolkit'); ?></h4>
                           </div>
                           <div class="sponsor-thumb">
                              <img src="<?php echo esc_html($sponsor_image['url']); ?>" alt="<?php echo esc_attr__('Sponsor','bdevs-toolkit'); ?>">
                           </div>
                        </div>
                     </div>
                  </div>
               <?php 
                endwhile; wp_reset_query();
                endif; 
               ?>
            </div>
         </div>
      </div>

<?php get_footer();  ?>