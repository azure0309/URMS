create table USERS
(
    ID             NUMBER(10)    not null
        constraint USERS_ID_PK
            primary key,
    NAME           VARCHAR2(255) not null,
    PERMISSION     NUMBER(10)    not null,
    EMAIL          VARCHAR2(255) not null
        constraint USERS_EMAIL_UK
            unique,
    PASSWORD       VARCHAR2(255) not null,
    REMEMBER_TOKEN VARCHAR2(100),
    CREATED_AT     TIMESTAMP(6),
    UPDATED_AT     TIMESTAMP(6)
)
/

INSERT INTO USERS (ID, NAME, PERMISSION, EMAIL, PASSWORD, REMEMBER_TOKEN, CREATED_AT, UPDATED_AT) VALUES (28, 'tuguldur.t', 7, 'tuguldur.t@unitel.mn', '$2y$10$pEQPQU/ljRvJRuxl1kSWuOpTpDiYQrA4.eJ.tLmsh0q5o30Vzmopi', 'dTqYnfnq4BQiWTrjD9lc6FfZQ6i2TaGyi2eFxhJfNqmFphFwUB5ihSJEM4hQ', DATE('2019-03-11 10:03:59.000000', 'YYYY-MM-DD HH24:MI:SS.FF6'), DATE('2019-11-04 02:54:25.000000', 'YYYY-MM-DD HH24:MI:SS.FF6'));
INSERT INTO USERS (ID, NAME, PERMISSION, EMAIL, PASSWORD, REMEMBER_TOKEN, CREATED_AT, UPDATED_AT) VALUES (7, 'bayarmaa', 6, 'bayarmaa@unitel.mn', '$2y$10$.W2EvE1taC13pr6MFzjyP.sA244y26Voyl79zMbWLARnGZbXf0gjO', 'wBbiN1MWe3mLhl5ZYD6esiKMtXk1zG9aYmUFBjymj4Nm4jcoEMjE7E5n5hTC', DATE('2019-04-08 01:23:06.000000', 'YYYY-MM-DD HH24:MI:SS.FF6'), DATE('2019-04-08 01:24:32.000000', 'YYYY-MM-DD HH24:MI:SS.FF6'));
INSERT INTO USERS (ID, NAME, PERMISSION, EMAIL, PASSWORD, REMEMBER_TOKEN, CREATED_AT, UPDATED_AT) VALUES (8, 'test', 6, 'test@gmail.com', '$2y$10$YAEsAzyd8CshQMrfRBeRP.3tRhhkaz9szCesi38qVQ5rnOabu./dy', null, DATE('2019-04-11 12:18:53.000000', 'YYYY-MM-DD HH24:MI:SS.FF6'), DATE('2019-04-11 12:18:53.000000', 'YYYY-MM-DD HH24:MI:SS.FF6'));
INSERT INTO USERS (ID, NAME, PERMISSION, EMAIL, PASSWORD, REMEMBER_TOKEN, CREATED_AT, UPDATED_AT) VALUES (21, 'batdelger.s', 6, 'batdelger.s@unitel.mn', '$2y$10$nxjFnLeSX7M4KM2KjRNT6.Y7DwAW9OGDJZqSqtseC4H9UGwAZ/FfG', 'oN1HVB2AKrQJWPAlCygKILH3rvc0EElwABm4xXCzrtoxzCiISGHoomkCGkOe', DATE('2019-03-11 09:24:06.000000', 'YYYY-MM-DD HH24:MI:SS.FF6'), DATE('2019-03-11 09:24:06.000000', 'YYYY-MM-DD HH24:MI:SS.FF6'));
INSERT INTO USERS (ID, NAME, PERMISSION, EMAIL, PASSWORD, REMEMBER_TOKEN, CREATED_AT, UPDATED_AT) VALUES (41, 'mungunsukh', 5, 'mungunsukh.p@unitel.mn', '$2y$10$0Hwd8br2fHV5Ok9uYqV1d.sGoW9tQ4G0k18.m.9.o0hWei6hT5xxi', null, DATE('2019-07-17 06:40:56.000000', 'YYYY-MM-DD HH24:MI:SS.FF6'), DATE('2019-07-17 06:40:56.000000', 'YYYY-MM-DD HH24:MI:SS.FF6'));
INSERT INTO USERS (ID, NAME, PERMISSION, EMAIL, PASSWORD, REMEMBER_TOKEN, CREATED_AT, UPDATED_AT) VALUES (3, 'bayarchimeg.ts', 6, 'bayarchimeg.ts@unitel.mn', '$2y$10$2d47Fx/gc5rvgymqgqAjju9OoITMKdt9VKIedDykD0./caoEoy49S', 'IeJ93HAc3H0eoj4UZqjahPrimxP4XoVFGELhshz4ObPc2ZkzOpI5UrcZKyXr', DATE('2019-03-11 09:28:11.000000', 'YYYY-MM-DD HH24:MI:SS.FF6'), DATE('2019-03-11 09:28:11.000000', 'YYYY-MM-DD HH24:MI:SS.FF6'));
INSERT INTO USERS (ID, NAME, PERMISSION, EMAIL, PASSWORD, REMEMBER_TOKEN, CREATED_AT, UPDATED_AT) VALUES (61, 'sainbileg', 5, 'sainbileg.a@unitel.mn', '$2y$10$SaGLb3xhWIdsnBBEj17TQuOMTWe.eOONSdGOFYBRlhVIfd0iCuQ9K', 'GTGxrttKky0yFawVTbe8WI50MolsZOfWwMFikdL3vOVrAo0MSXdIr0dmNBdH', DATE('2019-11-04 02:54:07.000000', 'YYYY-MM-DD HH24:MI:SS.FF6'), DATE('2019-11-04 02:54:07.000000', 'YYYY-MM-DD HH24:MI:SS.FF6'));
INSERT INTO USERS (ID, NAME, PERMISSION, EMAIL, PASSWORD, REMEMBER_TOKEN, CREATED_AT, UPDATED_AT) VALUES (23, 'omc', 5, 'omc@unitel.mn', '$2y$10$dm.AToHFAWKPc22ywHfLn.SJ1qne7mWy7jbh6kaH6IMEK9G2wnY72', '43gCCXIpJbxFtUEpPhBy1YCPKqYhKDhRrLqzaNYly23zQHs2vF50cCl9SsO2', DATE('2019-03-11 09:25:59.000000', 'YYYY-MM-DD HH24:MI:SS.FF6'), DATE('2019-03-11 09:25:59.000000', 'YYYY-MM-DD HH24:MI:SS.FF6'));
INSERT INTO USERS (ID, NAME, PERMISSION, EMAIL, PASSWORD, REMEMBER_TOKEN, CREATED_AT, UPDATED_AT) VALUES (24, 'batjargal.n', 5, 'batjargal.n@unitel.mn', '$2y$10$NK/Z/sDnEGVmhPAjnPA4iuZA1rWXYHo31jMGr3LM4uh8/43LMT0hm', 'Lx8n5n9da8kOpdt223pPpjUjYhEJyJDz1bwCdwoB474gGqAFkci791rMgkGf', DATE('2019-03-11 09:26:41.000000', 'YYYY-MM-DD HH24:MI:SS.FF6'), DATE('2019-11-04 02:54:33.000000', 'YYYY-MM-DD HH24:MI:SS.FF6'));