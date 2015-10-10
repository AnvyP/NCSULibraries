------------------------------------------------------------------
--  TABLE ROOM
------------------------------------------------------------------

CREATE TABLE ROOM
(
   ID     NUMBER (*, 0) NOT NULL,
   TYPE   VARCHAR2 (20) NOT NULL
)
NOCACHE
LOGGING;

ALTER TABLE room
   ADD CONSTRAINT sys_c00815001 PRIMARY KEY (id) VALIDATE;

ALTER TABLE room
   ADD CONSTRAINT type_values CHECK (TYPE IN ('Study', 'Conference'))
       VALIDATE;


