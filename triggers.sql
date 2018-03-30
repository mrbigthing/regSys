CREATE TRIGGER `activity_delete_trigger` AFTER DELETE ON `activities`
 FOR EACH ROW delete from activities_registration where activity_id=old.id