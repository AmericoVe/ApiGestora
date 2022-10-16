
SELECT area, COUNT(*) FROM orders where estado <>'cerrado' GROUP BY AREA ;
 
SELECT estado, COUNT(*) FROM orders GROUP BY estado ;

SELECT area, estado,  COUNT(*) FROM orders GROUP BY area,estado ;
 


select area, estado,  COUNT(*) count from `orders` group by area,estado

