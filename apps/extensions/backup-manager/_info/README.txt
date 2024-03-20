<h2>Backup Manager for MailWizz EMA</h2>

This extension enables one-click backup and scheduled backups for your <a title="MailWizz - The Email Marketing Application" href="http://codecanyon.net/item/mailwizz-email-marketing-application/6122150">MailWizz EMA</a> powered application!<br />
Since <a title="MailWizz - The Email Marketing Application" href="http://codecanyon.net/item/mailwizz-email-marketing-application/6122150">MailWizz EMA</a> is under a continue and active development, releasing new version on a regular basis, it's always a strugle and time consuming task to backup your data before an update.<br />
This extension aims to alleviate this and to make the entire update and backup process easier and faster, if until now the backup process took you hours now it just takes seconds!<br />

<h5>FEATURES</h5>
- One click backup<br />
- Schedule backups (i.e: backup once a day, once at 2 days, once at 10 days, etc)<br />
- Choose the number of backups to keep (i.e: keep only 10 most recent backups) <br />
- Notification system (notify by email when a backup is completed but also when it fails, multiple email address are allowed)<br />
- Backups listing<br />
- Manually Download / Delete backups from the web interface<br />

<h5>INSTALL in a few easy steps</h5>
- Login in the backend of your <a title="MailWizz - The Email Marketing Application" href="http://codecanyon.net/item/mailwizz-email-marketing-application/6122150">MailWizz EMA</a> powered website and navigate to Extensions menu.<br />
- Hit the upload button and select the extension archive and upload it.<br />
- Enable the extension then click on it's title to go to the extension page from where you can see input your backup details.<br />

<h5>CONFIGURE the extension (after the above steps)</h5>
After the extension is enabled, a new menu item will be shown in the left-side sidebar, that is "Backup manager".<br />
Clicking on the menu item followed by the Settings sub-menu will get you on the extension settings page.<br />
The most important setting is the "Storage path" which is the place where your backups will be stored.<br />
Please make sure you create the backup directory and you chmod it to 0777 so that it will be writable by the web server but also by the command line module, this is very IMPORTANT!<br />
Please do not set a backup directory inside your application files since you will backup your backup directoy too, resulting in huge backups from day to day.<br />
If <a title="MailWizz - The Email Marketing Application" href="http://codecanyon.net/item/mailwizz-email-marketing-application/6122150">MailWizz</a> is installed in /home/domain/public_html your backup directory should be one level up, like 
/home/domain/backups
<br />


<h5>REQUIREMENTS</h5>
The backup extension requires you to have the exec() function enabled in your PHP install since it will call a few command line commands to create the backups.<br />
Additionally, this only works on a linux environment where the "tar" and "mysqldump" commands are available (99% of linux servers have them)

<h5>QUESTIONS/SUPPORT</h5>
Please address any question, support ticket or any other query by using your mailwizz customer account.