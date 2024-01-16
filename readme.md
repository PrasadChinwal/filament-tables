# APP: SemesterPlanner


## Updating Course Schedule For New Term

Connect with SQL SErver Management Studio to the Schedule database
Job runs at 7am daily on UISCLNTSRVPROD1 D:\ITS_JOBS\Schedule\SCHEDULE.SQL
schedule.dbo.[LoadSchedule]

Add the term:
INSERT INTO [SCHEDULE_TERMS] (TERM_CD, TERMDESC, DEFAULT_TERM, BOOKSTORE_TERM) VALUES ('420221', 'Spring 2022', 1, 'Spring 2022');
REMOVE the DEFAULT_TERM FROM EXISTING SEMESTER RECORD
DELETE THE OLDEST SEMESTER
