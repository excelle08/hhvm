<?hh

function VS($x, $y) {
  var_dump($x === $y);
  if ($x !== $y) { echo "Failed: $y\n"; echo "Got: $x\n";
                   var_dump(debug_backtrace()); }
}
function VERIFY($x) { VS($x != false, true); }


//////////////////////////////////////////////////////////////////////


<<__EntryPoint>>
function main_ext_posix() {
VERIFY(posix_access(__DIR__."/ext_posix.php"));

VERIFY(strlen(posix_ctermid()));
VERIFY(strlen(posix_getcwd()));

$ret = posix_getgrgid(posix_getgid());
VERIFY($ret != false);
VERIFY(count(darray($ret)) != 0);

$bynam = posix_getgrnam($ret['name']);
VS($ret, $bynam);

$ret = posix_getgrnam("wheel");
VERIFY($ret != false);
VERIFY(count(darray($ret)) != 0);

$bygid = posix_getgrgid($ret['gid']);
VS($ret, $bygid);

// $ret = posix_getgroups();
// VERIFY($ret != false);
// VERIFY(count(darray($ret)) != 0);

VERIFY(posix_getpgid(0));
VERIFY(posix_getpgrp());
VERIFY(posix_getpid());
VERIFY(posix_getppid());

$ret = posix_getpwnam("root");
VERIFY($ret != false);
VERIFY(count(darray($ret)) != 0);
VS(posix_getpwnam(""), false);
VS(posix_getpwnam('-1'), false);

$ret = posix_getpwuid(0);
VERIFY($ret != false);
VERIFY(count(darray($ret)) != 0);
VS(posix_getpwuid(-1), false);

$ret = posix_getrlimit();
VERIFY($ret != false);
VERIFY(count(darray($ret)) != 0);

VERIFY(posix_getsid(posix_getpid()) !== false);

$tmpfifo = tempnam(sys_get_temp_dir(), 'vmmkfifotest');
unlink($tmpfifo);
VERIFY(posix_mkfifo($tmpfifo, 0));

VERIFY(posix_setpgid(0, 0));
VERIFY(posix_setsid());

VERIFY(strlen(posix_strerror(1 /* EPERM */)));

$ret = posix_times();
VERIFY($ret != false);
VERIFY(count(darray($ret)) != 0);

$ret = posix_uname();
VERIFY($ret != false);
VERIFY(count(darray($ret)) != 0);
}
