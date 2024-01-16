<?php

namespace App\Helpers;

use PDO;
use Mail;
use App\TeamAdmin;
use App\Supervisor;
use App\TeamFaculty;
use App\TeamDeptAdmin;
use App\DeanDeptChairInfo;
use App\DeptChairDeanInfo;
use Adldap\Laravel\Facades\Adldap;
use Illuminate\Support\Facades\DB;
use App\TeamDean;

class Helper
{
    public static function sendEmail($from, $to, $subject, $html)
    {
        Mail::send(array(), array(), function ($message) use ($from, $html, $to, $subject) {
            $message->from($from);
            $message->to($to);
            $message->subject($subject);
            $message->setBody($html, 'text/html');
        });
    }

    public static function getSemester()
    {
        $semester = DB::connection("oraclecdmpvt")->table('vw_semester')->value('current_term');
        return $semester;
    }

    public static function getSupervisor($uin)
    {
        $supervisor_info = DB::connection("oraclecdmpvt")->table('EMP_SUPV_DEPT_UIS')->where('uin', $uin)->first();
        return $supervisor_info->supv_fname . ' ' . $supervisor_info->supv_lname;
    }

    public static function getFullNameFromUin($uin)
    {
        $result = '';
        $search = Adldap::search()->where('extensionattribute1', '=', $uin)->get();
        if (isset($search[0]->cn[0])) {
            $result = $search[0]->givenname[0] . ' ' . $search[0]->sn[0];
        }
        return $result;
    }

    public static function getProvostUin()
    {
        $supervisor_info = DB::connection("oraclecdmpvt")->table('EMP_SUPV_DEPT_UIS')->where('posn_title', 'VCHAN ACAD AFF & PROV')->first();
        return $supervisor_info->uin;
    }

    public static function getStudentInfo($uin, $semester)
    {
        $student_info = DB::connection("oraclecdmpvt")->table('Attendance_Stu_Courses')->where('UIN', $uin)->where('TERM_CD', $semester)->first();
        return $student_info;
    }

    public static function isDeanDirectorAVC($uin)
    {
        $result = false;
        $result =  DB::connection("oraclecdmpvt")->table('EMP_SUPV_DEPT_UIS')
            ->where('uin', $uin)
            ->where(function ($query) {
                $query->whereIn('empee_coll_cd', ['SB', 'PL', 'PK', 'PH', 'PG', 'PF', 'PE']);
                $query->whereNotIn('empee_group_cd', ['S', 'E', 'G', 'T', 'H']);
            })
            ->where(function ($query) {
                $query->orWhere('posn_title', 'LIKE', '%DEAN%');
                $query->orWhere('posn_title', 'LIKE', '%DIRECTOR%');
                $query->orWhere('posn_title', 'LIKE', '%EXEC DIR%');
                $query->orWhere('posn_title', 'LIKE', '%VCHAN%');
                $query->orWhere('posn_title', 'LIKE', 'ASSOC VC%');
                $query->orWhere('posn_title', 'LIKE', '%CIO%');
                $query->orWhere('posn_title', 'LIKE', 'PRVST%');
            })->get()->isNotEmpty();

        return $result;
    }

    public static function getTitleFromUin($uin)
    {
        $supervisor_info = DB::connection("oraclecdmpvt")->table('EMP_SUPV_DEPT_UIS')->where('uin', $uin)->first();

        return $supervisor_info->posn_title;
    }

    public static function getUinFromBarcode($barcode)
    {
        $uin = '';

        if (strlen($barcode) == 9) {
            $uin = $barcode;
        } else {
            $uin = substr($barcode, 4, 9);
        }
        return $uin;
    }

    public static function getLoggedUserNetid()
    {
        $result = '';
        if (isset($_SERVER['cn'])) {
            $result = $_SERVER['cn'];
        }
        return $result;
    }

    public static function getLoggedUserUIN()
    {
        $result = '';
        if (isset($_SERVER['iTrustUIN'])) {
            $result = $_SERVER['iTrustUIN'];
        }
        return $result;
    }

    public static function getNetidFromUIN($uin)
    {
        $result = '';
        $search = Adldap::search()->where('extensionattribute1', '=', $uin)->get();
        if (isset($search[0]->cn[0])) {
            $result = $search[0]->cn[0];
        }
        return $result;
    }

    /**
     * Check if User is an admin
     * @param UIN
     * @return true|false
     */
    public static function isUserAdmin($adminUIN)
    {
        if ($adminUIN == '' || strlen($adminUIN) != 9) {
            return false;
        }

        $faculty = TeamAdmin::find($adminUIN);
        if (!empty($faculty)) {
            return true;
        }
        return false;
    }

    /**
     * User is Dean
     * @param LoggedIn User netid
     * @return true|false
     */
    public static function isUserDean($deanUIN)
    {
        if ($deanUIN == '' || strlen($deanUIN) != 9) {
            return false;
        }

        $faculty = TeamDean::find($deanUIN);
        if (!empty($faculty)) {
            return true;
        }

        return false;
    }

    /**
     * User is Dept Admin
     * @param LoggedIn User netid
     * @return true|false
     */
    public static function isUserDeptAdmin($deptAdminUIN)
    {
        if ($deptAdminUIN == '' || strlen($deptAdminUIN) != 9) {
            return false;
        }

        $deptAdmin = TeamDeptAdmin::find($deptAdminUIN);
        if (!empty($deptAdmin)) {
            return true;
        }

        return false;
    }

    /**
     * User is faculty
     * @param LoggedIn User netid
     * @return true|false
     */
    public static function isUserFaculty($facultyUIN)
    {
        if ($facultyUIN == '' || strlen($facultyUIN) != 9) {
            return false;
        }

        $faculty = TeamFaculty::find($facultyUIN);
        if (!empty($faculty)) {
            return true;
        }
        return false;
    }
}//end of Helper Class
