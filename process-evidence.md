# Process Evidence Log

Student: Rahma Elsaify (S4202989) | Assessment 2 – BookVerse dynamic site

This file combines debugging records and AI usage records, written during development.

---

# Section 1: Debugging Records

## Bug 1: mysql command cannot log in (sha256_password)

**Date Identified:** 9/10/2026
**Date Fixed:** [date you got the import working]

**File Affected:** `bookverse.sql` (database import on Coreteaching)

**Related Commit:** [paste commit link that added/changed bookverse.sql]

**Symptom:**
Running `mysql -h talsprddb02.int.its.rmit.edu.au -u s4202989 -p s4202989 < bookverse.sql` printed
`ERROR 2059 (HY000): Authentication plugin 'sha256_password' cannot be loaded ... cannot open shared object file`.
The tables were not created.

**Root Cause:**
The mysql command-line client installed on the Coreteaching server does not have the plugin needed for my Jacob 5 account's login method, so it could not authenticate.

**Fix Applied:**
Wrote a small PHP script that connects with `mysqli_connect` and runs the SQL file with `mysqli_multi_query`, because PHP's mysqli can log in to Jacob 5.

**Verification / Testing:**
[Fill in only after it works, e.g. the script printed "Imported OK. Rows in books: 12" and I checked the books table.]

---

## Bug 2: Access denied when connecting to Jacob 5

**Date Identified:** 9/10/2026
**Date Fixed:** [date]

**File Affected:** `includes/db_connect.inc` (and my private password file outside the repository)

**Related Commit:** [commit link for db_connect.inc]

**Symptom:**
`Fatal error: Uncaught mysqli_sql_exception: Access denied for user 's4202989'@'...' (using password: YES)` when the import script ran.

**Root Cause:**
The password file that db_connect.inc includes contained the wrong value (my student ID instead of the database password issued by RMIT IT).

**Fix Applied:**
[Describe what you actually did, e.g. found the correct password from RMIT IT and corrected the password file.]

**Verification / Testing:**
[e.g. connection succeeded and test page showed "Books in table: 12".]

---

## Bug 3: Call to undefined function mysqli_report() on localhost

**Date Identified:** 9/10/2026
**Date Fixed:** [date]

**File Affected:** `includes/db_connect.inc` line 3 (XAMPP `php.ini` setting)

**Related Commit:** [commit link for db_connect.inc]

**Symptom:**
Opening `index.php` on XAMPP showed `Fatal error: Uncaught Error: Call to undefined function mysqli_report()`.

**Root Cause:**
The mysqli extension was not enabled in XAMPP's `php.ini`, so PHP had none of the mysqli functions.

**Fix Applied:**
Enabled `extension=mysqli` in `php.ini` by removing the leading semicolon, then restarted Apache.

**Verification / Testing:**
[e.g. reloaded http://localhost:8080/a2/index.php and the error was gone.]

---

## Bug 4: SQL file comments broke the CREATE DATABASE statement

**Date Identified:** 9/10/2026 (found by reviewing the file before importing)
**Date Fixed:** [date]

**File Affected:** `bookverse.sql`

**Related Commit:** [commit link for bookverse.sql]

**Symptom:**
The top of the file had `--CREATE DATABASE ...` and an active `USE bookverse;` in the middle of the statement, leaving the `DEFAULT CHARACTER SET` lines orphaned.

**Root Cause:**
In MySQL a `--` comment needs a space after it, so `--CREATE` was not a comment. The `USE bookverse;` line also does not belong on Jacob 5, where my database is named after my student ID.

**Fix Applied:**
Commented every line with `-- ` (including the space) so CREATE DATABASE and USE are fully disabled for Jacob 5.

**Verification / Testing:**
[e.g. import ran with no syntax error and the books table had 12 rows.]

---

# Section 2: AI Usage Records

## AI Use 1: Planning the assessment

**Date:** [date]
**Tool Used:** Claude
**Task:** Understand the Assessment 2 brief and plan the steps for each page.
**Prompt / Input:** "find attached part 2 of the assessment: explain the required steps to complete the assessment and the changes in each page" (I attached the brief, the SQL file and the sample report).
**Summary of AI Output:** A step-by-step plan: folder setup, database, db_connect.inc, includes, converting the five pages, security, deployment, documentation.
**Accepted / Rejected / Modified:** [e.g. I followed the order of steps. I did not use ... because ...]
**How I Tested / Verified:** [e.g. checked each requirement against the brief and the sample autograder report.]

## AI Use 2: Database connection and includes

**Date:** [date]
**Tool Used:** Claude
**Task:** Write includes/db_connect.inc that works on localhost and Jacob 5, plus header, nav and footer includes.
**Prompt / Input:** "explain the following ... the site should work with both database servers" and I attached my instructor's example db_connect.inc and header.inc.
**Summary of AI Output:** A connection file that checks the server name, uses the password from a file outside the website folder, and three include files.
**Accepted / Rejected / Modified:** [e.g. I used the separate password-file approach from my instructor's example. I changed ... ]
**How I Tested / Verified:** [e.g. ran the detection test commands, opened the site on localhost and Coreteaching.]

## AI Use 3: Converting my Assessment 1 pages to PHP

**Date:** [date]
**Tool Used:** Claude
**Task:** Convert index, books, gallery and add pages to PHP using database data and prepared statements, plus details.php and process_add.php.
**Prompt / Input:** "explain from the beginning the steps and create the files here in the chat based on the attached previous project with the new requirements" (I attached my Assessment 1 zip).
**Summary of AI Output:** PHP versions of the pages that kept my CSS and JavaScript, used mysqli prepared statements, and fixed issues found in my Part 1 files.
**Accepted / Rejected / Modified:** [e.g. what you kept, changed, or rejected, such as genre options or colours.]
**How I Tested / Verified:** [e.g. checked each page in the browser, added a book through the form, confirmed it appeared in the database and gallery.]

## AI Use 4: Diagnosing errors

**Date:** [date]
**Tool Used:** Claude
**Task:** Understand and fix the errors in Bugs 1 to 4.
**Prompt / Input:** "whats wrong" followed by the exact error text (for example the ERROR 2059 message).
**Summary of AI Output:** Explanations of each error's cause and the steps to fix it.
**Accepted / Rejected / Modified:** [e.g. I used the PHP import script instead of the mysql command. I did not ...]
**How I Tested / Verified:** [e.g. re-ran the command and checked the result as described in each bug record.]