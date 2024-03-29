create table T_INVOICE_CLOSE_PAYMENT
(
    OPERATOR   VARCHAR2(200),
    PROD_NO    VARCHAR2(20),
    PAYMENT    NUMBER,
    BILL_MONTH VARCHAR2(20),
    STATUS     VARCHAR2(30),
    CURRENCY   VARCHAR2(10)
)
/

INSERT INTO T_INVOICE_CLOSE_PAYMENT (OPERATOR, PROD_NO, PAYMENT, BILL_MONTH, STATUS, CURRENCY) VALUES ('ORANGE', '88794058', 108140, '202008', 'UNPAID', 'USD');
INSERT INTO T_INVOICE_CLOSE_PAYMENT (OPERATOR, PROD_NO, PAYMENT, BILL_MONTH, STATUS, CURRENCY) VALUES ('ORANGE', '88794060', 24165, '202008', 'UNPAID', 'USD');
INSERT INTO T_INVOICE_CLOSE_PAYMENT (OPERATOR, PROD_NO, PAYMENT, BILL_MONTH, STATUS, CURRENCY) VALUES ('ORANGE', '88794058', 56685, '202007', 'UNPAID', 'USD');
INSERT INTO T_INVOICE_CLOSE_PAYMENT (OPERATOR, PROD_NO, PAYMENT, BILL_MONTH, STATUS, CURRENCY) VALUES ('ORANGE', '88794060', 94585, '202007', 'UNPAID', 'USD');
INSERT INTO T_INVOICE_CLOSE_PAYMENT (OPERATOR, PROD_NO, PAYMENT, BILL_MONTH, STATUS, CURRENCY) VALUES ('SK TELECOM', '88792324', 2300, '202008', 'UNPAID', null);
INSERT INTO T_INVOICE_CLOSE_PAYMENT (OPERATOR, PROD_NO, PAYMENT, BILL_MONTH, STATUS, CURRENCY) VALUES ('SK TELECOM', '88790573', 5760, '202002', 'UNPAID', null);
INSERT INTO T_INVOICE_CLOSE_PAYMENT (OPERATOR, PROD_NO, PAYMENT, BILL_MONTH, STATUS, CURRENCY) VALUES ('SK TELECOM', '88790573', 2880, '202004', 'UNPAID', null);
INSERT INTO T_INVOICE_CLOSE_PAYMENT (OPERATOR, PROD_NO, PAYMENT, BILL_MONTH, STATUS, CURRENCY) VALUES ('SK TELECOM', '88790573', 4770, '202005', 'UNPAID', null);
INSERT INTO T_INVOICE_CLOSE_PAYMENT (OPERATOR, PROD_NO, PAYMENT, BILL_MONTH, STATUS, CURRENCY) VALUES ('SASKTEL', '88790269', 4514.8, '202003', 'UNPAID', null);
INSERT INTO T_INVOICE_CLOSE_PAYMENT (OPERATOR, PROD_NO, PAYMENT, BILL_MONTH, STATUS, CURRENCY) VALUES ('SASKTEL', '88790271', 110405.86, '202003', 'UNPAID', null);