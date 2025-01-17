(*
 * Copyright (c) 2015, Facebook, Inc.
 * All rights reserved.
 *
 * This source code is licensed under the MIT license found in the
 * LICENSE file in the "hack" directory of this source tree.
 *
 *)

open Core
include WrappedMap.Make (StringKey)

let pp : (Format.formatter -> 'a -> unit) -> Format.formatter -> 'a t -> unit =
 (fun pp_data -> make_pp (fun fmt s -> Format.fprintf fmt "%S" s) pp_data)

let show pp_data x = Format.asprintf "%a" (pp pp_data) x

let hash_fold_t x = make_hash_fold_t hash_fold_string x
