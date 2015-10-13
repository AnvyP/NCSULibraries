------------------------------------------------------------------
--  TABLE CONFERENCEBOOKING
------------------------------------------------------------------

CREATE TABLE CONFERENCEBOOKING
(
   "UnityId"        VARCHAR2 (20),
   "CheckoutTime"   VARCHAR2 (20),
   "Upto"           VARCHAR2 (20),
   "Id"             VARCHAR2 (20)
)
NOCACHE
LOGGING;

ALTER TABLE conferencebooking
   ADD CONSTRAINT fk_bookings_1 FOREIGN KEY ("UnityId")
       REFERENCES rnagill.faculty ("UnityId")
       VALIDATE;

ALTER TABLE conferencebooking
   ADD CONSTRAINT sys_c00815763 FOREIGN KEY ("Id")
       REFERENCES rnagill.conference_room ("Id")
       VALIDATE;


