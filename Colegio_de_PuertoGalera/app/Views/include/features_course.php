<div class="course-area ptb--120">
    <div class="container">
        <div class="row">
            <div class="col-md-10 offset-md-1">
                <div class="section-title-style2 black-title title-tb text-center">
                    <span>Build Your Career</span>
                    <h2 class="primary-color">Featured Courses</h2>
                </div>
            </div>
        </div>
        <div class="row">
            <?php if (empty($courses)): ?>
                <div class="col-12 text-center">
                    <p>No courses available at the moment.</p>
                </div>
            <?php else: ?>
                <?php foreach ($courses as $course): ?>
                    <div class="col-md-6">
                        <div class="card mb-5">
                            <div class="course-thumb">
                                <img class="course-image" src="/uploads/<?= $course['image'] ?>" alt="Course Image">
                            </div>
                            <div class="course-title text-center mt-3">
                                <h4><a href="course-details.html"><?= $course['title'] ?></a></h4>
                            </div>
                            <div class="card-body p-25">
                                <p><?= $course['description'] ?></p>
                                <ul class="course-meta-details list-inline w-100">
                                    <li>
                                        <p>Course</p>
                                        <span><?= $course['course'] ?></span>
                                    </li>
                                    <li>
                                        <p>Course Unit</p>
                                        <span><?= $course['course_unit'] ?></span>
                                    </li>
                                    <li>
                                        <p>Subject</p>
                                        <span><?= $course['subject'] ?></span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
</div>
