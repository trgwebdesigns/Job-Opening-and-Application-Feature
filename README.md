# Job Opening and Application Feature

Adds a custom post type for Job Openings and the ability for website visitors apply for jobs.

The plugin creates a Job Openings custom post type and a Job Category taxonomy. It also dynamically inserts an Apply Now button after the content of all Job Opening posts with a link to the job application page that includes the job_title as a query string parameter.

To complete the feature additional work needs to completed:

* Create a job application form in Gravity Forms.
  * Dynamically populate the Position Applying For field with the job_title URL parameter.
* Create a Job Application page and embed the Job Application form.
  * The slug for the page needs to be 'job-application' (in order for the Apply Now button to properly link to the application page).
* Create a Job Openings page that uses a Blog Module to display Job Opening posts.
* In the Divi Theme Builder:
  * Create a template for All Job Openings. The only requirement is that it contain a Post Content Module.
  * Create a template for Job Opening Categories. Use a Blog Module that has the Posts for Current Page option set to 'Yes'.
